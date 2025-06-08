<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\CryptoHelper;
use Yajra\DataTables\Facades\DataTables;


class KaryawanController extends Controller
{
    public static $information = [
        "title" => "Karyawan",
        "route" => "/master/karyawan",
        "view" => "pages.masters.karyawan."
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $karyawan = Karyawan::join('pelamar', 'pelamar.id', '=', 'karyawan.pelamar_id')
                ->select("karyawan.*", "pelamar.nama as nama");
            return DataTables::of($karyawan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encrypted_id = Crypt::encrypt($row->id);
                    $url = url(self::$information['route'] . '/edit') . '/' . $encrypted_id;
                    $view = url(self::$information['route'] . '/view') . '/' . $encrypted_id;
                    $delete_action = 'delete_confirm("' . url(self::$information['route'] . '/delete') . '/' . $encrypted_id . '")';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<a class='btn bg-warning-transparent' href='$url' title='Edit Data'><i class='fa fa-pen'></i></a>";
                    $btn .= "<a class='btn bg-danger-transparent' href='#' onclick='$delete_action' title='Hapus Data'><i class='fa fa-trash'></i></a>";
                    $btn .= "<a class='btn bg-warning-transparent' href='$view' title='Edit Data'><i class='fa fa-eye'></i></a>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        };

        return view(self::$information['view'] . 'index', [
            "information" => self::$information
        ]);
    }
    public function create(Request $request)
    {
        $pelamar = Pelamar::select("id", "nama", "divisi", "jeniskelamin", "alamat", "tanggallahir", "notelepon", "nik", "email")->get();
        return view(self::$information['view'] . 'add', [
            "information" => self::$information,
            "pelamar" => $pelamar
        ]);
    }

    public function edit($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $karyawan = Karyawan::find($decrypt->id);

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "karyawan" => $karyawan,
        ]);
    }

    public function view($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $karyawan = Karyawan::find($decrypt->id);

        return view(self::$information['view'] . 'view', [
            "information" => self::$information,
            "karyawan" => $karyawan,
        ]);
    }

    public function store(Request $request)
    {
        $result = Karyawan::do_store($request);
        return response()->json($result["client_response"], $result["code"]);
    }

    // Proses update data dari form edit ke model
    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Karyawan::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }

    // Proses hapus data
    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Karyawan::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }

    public function getdata($id)
    {
        $data = Pelamar::find($id);
        return response()->json($data);
    }
}
