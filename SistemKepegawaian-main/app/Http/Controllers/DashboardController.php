<?php
// digunakan untuk mengorganisasi dan mengelompokkan kelas-kelas dalam aplikas
namespace App\Http\Controllers;
//mengimpor model StockAmount yang digunakan dalam controller, Model StockAmount merepresentasikan jumlah stok dari suatu produk.
use App\Models\Izin;
use App\Models\Cuti;
use App\Models\Divisi;
use Illuminate\Http\Request;//mengakses dan memanipulasi data permintaans
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;

//digunakan untuk mengelola tampilan dan logika terkait dashboard.
class DashboardController extends Controller
{
    //
    // public function index(Request $request)
    // {   
    //     $izin = new Izin;
    //     $izin = $izin->select("izin.*");
    //     return view("pages.dashboards.index");
    // }
    public static $information = [
        "route" => "/dashboards/index",
        "view" => "pages.dashboards."
    ];
    public function index(Request $request)
    {
        $cuti = new Cuti;
        $cuti = $cuti->select("cuti.*")->whereNotNull('acc') ->get();
        $izin = new Izin;
        $izin = $izin->select("izin.*")->whereNotNull('acc') ->get();

        return view(self::$information['view'] . 'index', [
            "information" => self::$information,
            "cuti" => $cuti,
            "izin" => $izin
        ]);
    }
}
