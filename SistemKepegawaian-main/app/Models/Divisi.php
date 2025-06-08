<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;

class Divisi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "divisi";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi

    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'divisi' => 'required'
        ]);

        // Proses input
        try {
            DB::beginTransaction();

            // Proses Input data
            $divisi = new Divisi;
            $divisi->divisi = $request->divisi;
            $divisi->description = $request->description;

            $divisi->created_by = 1;
            $divisi->save();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Proses Input Berhasil", "Data telah disimpan");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Proses Input Gagal", "Proses input data gagal! " . $e);
        }
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'divisi_id');
    }
    public function izin()
    {
        return $this->hasMany(Izin::class, 'divisi_id');
    }

    public static function do_update($id, Request $request)
    {
        // Proses validasi
  
        // Proses update
        try {
            DB::beginTransaction();

            // Proses cari data
            $divisi = Divisi::find($id);

            // Cek data ada di database
            if ($divisi == null) return ResponseHelper::response_error("Proses Ubah Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $divisi->divisi = $request->divisi;
            $divisi->description = $request->description;

            $divisi->created_by = 1;
            $divisi->save();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Proses Ubah Berhasil", "Data telah disimpan");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Proses Ubah Gagal", "Proses input data gagal!");
        }
    }

    public static function do_delete($id)
    {
        try {
            DB::beginTransaction();

            // Proses Input data
            $divisi = Divisi::find($id);

            // Cek data ada di database
            if ($divisi == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $divisi->delete();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Proses Hapus Berhasil", "Data telah dihapus");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Proses Hapus Gagal", "Proses hapus data gagal!");
        }
    }
}
