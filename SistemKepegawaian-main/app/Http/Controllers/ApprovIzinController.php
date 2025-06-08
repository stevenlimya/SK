<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApproveIzin;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\CryptoHelper;
use Yajra\DataTables\Facades\DataTables;

class ApprovIzinController extends Controller
{
    public static $information = [
        "title" => "Approval Izin",
        "route" => "/master/approvizin",
        "view" => "pages.masters.approvizin."   
    ];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $izin = new ApproveIzin;
            $izin = $izin->select("izin.*");
            return DataTables::of($izin)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encrypted_id = Crypt::encrypt($row->id);
                    $url = url(self::$information['route'] . '/edit') . '/' . $encrypted_id;
                    $delete_action = 'delete_confirm("' . url(self::$information['route'] . '/delete') . '/' . $encrypted_id . '")';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<a class='btn bg-warning-transparent' href='$url' title='Edit Data'><i class='fa fa-arrow-right'></i></a>";
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

    public function edit($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $izin = ApproveIzin::find($decrypt->id);

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "izin" => $izin,
        ]);
        
    }

    // Proses update data dari form edit ke model
    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = ApproveIzin::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }


    // Proses hapus data
    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = ApproveIzin::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }
}
