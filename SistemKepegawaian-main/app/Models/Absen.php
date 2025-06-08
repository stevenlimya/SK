<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbsenImport;

class Absen extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['nama', 'checkin', 'checkout', 'tanggal'];
    protected $table = "absen";


    public static function do_delete($id)
    {
        try {
            DB::beginTransaction();

            // Proses Input data
            $absen = Absen::find($id);

            // Cek data ada di database
            if ($absen == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $absen->delete();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Proses Hapus Berhasil", "Data telah dihapus");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Proses Hapus Gagal", "Proses hapus data gagal!");
        }
    }

    public static function do_import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);

            Excel::import(new AbsenImport(), $request->file('file'));
     }
}
