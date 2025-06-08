<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApproveCuti;
use App\Models\Divisi;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\CryptoHelper;
use Yajra\DataTables\Facades\DataTables;
class ApprovCutiController extends Controller
{
    public static $information = [
        "title" => "Approval Cuti",
        "route" => "/master/approvcuti",
        "view" => "pages.masters.approvcuti."   
    ];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cuti = new ApproveCuti;
            $cuti = $cuti->select("cuti.*");
            return DataTables::of($cuti)
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

        $cuti = ApproveCuti::find($decrypt->id);

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "cuti" => $cuti,
        ]);
        
    }

    // Proses update data dari form edit ke model
    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = ApproveCuti::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }


    // Proses hapus data
    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = ApproveCuti::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }
}
