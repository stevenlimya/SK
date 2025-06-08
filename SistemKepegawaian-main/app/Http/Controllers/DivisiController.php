<?php

namespace App\Http\Controllers;

use App\Helpers\CryptoHelper;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class DivisiController extends Controller
{
    public static $information = [
        "title" => "Divisi",
        "route" => "/master/divisi",
        "view" => "pages.masters.divisi."
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $divisi = new Divisi;
            $divisi = $divisi->select("divisi.*");
            return DataTables::of($divisi)
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Divisi::do_store($request);
        return response()->json($result["client_response"], $result["code"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $divisi = Divisi::find($decrypt->id);

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "divisi" => $divisi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Divisi::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }

    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Divisi::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }
}
