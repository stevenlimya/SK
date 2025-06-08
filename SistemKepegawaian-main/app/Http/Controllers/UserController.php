<?php

namespace App\Http\Controllers;

use App\Helpers\CryptoHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public static $information = [
        "title" => "Akun",
        "route" => "/master/user",
        "view" => "pages.masters.users."
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = new User;
            $users = $users->select("users.*");
            return DataTables::of($users)
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view(self::$information['view'] . 'add', [
            "information" => self::$information
        ]);
    }

    //form untuk edit data
    public function edit($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $users = User::find($decrypt->id);

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "users" => $users
        ]);
    }

    // ======================
    // Line Proses - START
    // ======================


    // Proses input data yang diinput user di view ke model
    public function store(Request $request)
    {
        $result = User::do_store($request);
        return response()->json($result["client_response"], $result["code"]);
    }


    // Proses update data dari form edit ke model
    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = User::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }


    // Proses hapus data
    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = User::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }
}
