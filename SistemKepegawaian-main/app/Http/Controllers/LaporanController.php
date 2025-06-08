<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResainExport; 
use App\Exports\IzinExport; 
use App\Exports\AbsenExport; 
use App\Exports\CutiExport; 
use Illuminate\Support\Facades\Redirect;

class LaporanController extends Controller
{
    public static $information = [
        "title" => "Laporan",
        "route" => "/master/laporan",
        "view" => "pages.masters.laporan."
    ];

    public function index(Request $request)
    {

        return view(self::$information['view'] . 'index', [
            "information" => self::$information
        ]);
    }
    public function exportReport(Request $request)
    {
        $report_type = $request->report_type;
        
        switch ($report_type) {
            case 'izin':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                return Excel::download(new IzinExport($startDate, $endDate), 'laporan_izin.xlsx');
            case 'cuti':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                return Excel::download(new CutiExport($startDate, $endDate), 'laporan_cuti.xlsx');
            case 'absen':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                return Excel::download(new AbsenExport($startDate, $endDate), 'laporan_absen.xlsx');
            case 'resain':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                return Excel::download(new ResainExport($startDate, $endDate), 'laporan_resain.xlsx');
            default:
            return redirect::back()->with('error', 'Gagal Export Data! Harap Pilih Laporan Yang Mau Di Export');
        }
    }
}
