<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanksi;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\CryptoHelper;
use Yajra\DataTables\Facades\DataTables;

class SanksiController extends Controller
{
    public static $information = [
        "title" => "Sanksi",
        "route" => "/master/sanksi",
        "view" => "pages.masters.sanksi."
    ];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sanksi = Sanksi::join('karyawan', 'karyawan.id', '=', 'sanksi.karyawan_id')
            ->select("sanksi.*", "karyawan.nama as nama");
            return DataTables::of($sanksi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encrypted_id = Crypt::encrypt($row->id);
                    $url = url(self::$information['route'] . '/edit') . '/' . $encrypted_id;
                    $delete_action = 'delete_confirm("' . url(self::$information['route'] . '/delete') . '/' . $encrypted_id . '")';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<a class='btn bg-warning-transparent' href='$url' title='Edit Data'><i class='fa fa-pen'></i></a>";
                    $btn .= "<a class='btn bg-danger-transparent' href='#' onclick='$delete_action' title='Hapus Data'><i class='fa fa-trash'></i></a>";
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
        $karyawan = Karyawan::select("id", "nama", "divisi")->get();
        return view(self::$information['view'] . 'add', [
            "information" => self::$information,
            "karyawan" => $karyawan
        ]);
    }

    public function edit($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $sanksi = Sanksi::find($decrypt->id);
        $karyawan = Karyawan::select("id", "nama")->get();

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "sanksi" => $sanksi,
            "karyawan" => $karyawan,
        ]);
        
    }

    // Proses input data yang diinput di view ke model
    public function store(Request $request)
    {
        $result = Sanksi::do_store($request);
        return response()->json($result["client_response"], $result["code"]);
    }


    // Proses update data dari form edit ke model
    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Sanksi::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }

    // Proses hapus data
    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Sanksi::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }
    
    public function getdata($id)
    {
        $data = Karyawan::find($id);
        return response()->json($data);
    }
}
