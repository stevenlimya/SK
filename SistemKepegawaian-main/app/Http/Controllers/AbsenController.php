<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\CryptoHelper;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;

class AbsenController extends Controller
{
    public static $information = [
        "title" => "Absen",
        "route" => "/master/absen",
        "view" => "pages.masters.absen."
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $absen = new Absen();
            $absen = $absen->select("absen.*");
            return DataTables::of($absen)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encrypted_id = Crypt::encrypt($row->id);
                    $url = url(self::$information['route'] . '/edit') . '/' . $encrypted_id;
                    $delete_action = 'delete_confirm("' . url(self::$information['route'] . '/delete') . '/' . $encrypted_id . '")';
                    $btn = "<div class='btn-group'>";
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

    public function import(Request $request)
    {
        try {
        $result = Absen::do_import($request);
        return Redirect::back()->with('success', 'Data Berhasil Diimport!');
        } catch (\Exception $e) {
            return redirect::back()->with('error', 'Gagal Import Data! Coba Periksa Kembali File');
        }
    }

    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Absen::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }
}
