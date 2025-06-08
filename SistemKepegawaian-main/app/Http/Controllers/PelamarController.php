<?php

namespace App\Http\Controllers;

use App\Helpers\CryptoHelper;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PelamarController extends Controller
{
    public static $information = [
        "title" => "Pelamar",
        "route" => "/master/pelamar",
        "view" => "pages.masters.pelamar."
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pelamar = new Pelamar;
            $pelamar = $pelamar->select("pelamar.*");
            return DataTables::of($pelamar)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encrypted_id = Crypt::encrypt($row->id);
                    $url = url(self::$information['route'] . '/edit') . '/' . $encrypted_id;
                    $view = url(self::$information['route'] . '/view') . '/' . $encrypted_id;
                    $delete_action = 'delete_confirm("' . url(self::$information['route'] . '/delete') . '/' . $encrypted_id . '")';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<a class='btn bg-warning-transparent' href='$url' title='Unduh Data'><i class='fa fa-pen'></i></a>";
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

    public function view($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $pelamar = Pelamar::find($decrypt->id);

        return view(self::$information['view'] . 'view', [
            "information" => self::$information,
            "pelamar" => $pelamar,
        ]);
    }

    public function edit($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $pelamar = Pelamar::find($decrypt->id);

        return view(self::$information['view'] . 'edit', [
            "information" => self::$information,
            "pelamar" => $pelamar,
        ]);
    }

    public function update($id, Request $request)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Pelamar::do_update($decrypt->id, $request);
        return response()->json($result["client_response"], $result["code"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view(self::$information['view'] . 'add', [
            "information" => self::$information,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Pelamar::do_store($request);
        return response()->json($result["client_response"], $result["code"]);
    }

    public function destroy($id)
    {
        $decrypt = CryptoHelper::decrypt($id);
        if (!$decrypt->success) return $decrypt->error_response;

        $result = Pelamar::do_delete($decrypt->id);
        return response()->json($result["client_response"], $result["code"]);
    }

}
