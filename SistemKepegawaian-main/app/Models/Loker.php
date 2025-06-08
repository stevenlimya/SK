<?php

namespace App\Models;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Loker extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "loker";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi

    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'judul' => 'required',
            'deskripsi1' => 'required',
            'persyaratan1' => 'required'
        ]);

        // Proses input
        try {
            DB::beginTransaction();

            // Proses Input data
            $loker = new Loker;
            $loker->judul = $request->judul;
            $loker->deskripsi1 = $request->deskripsi1;
            $loker->deskripsi2 = $request->deskripsi2;
            $loker->deskripsi3 = $request->deskripsi3;
            $loker->deskripsi4 = $request->deskripsi4;
            $loker->persyaratan1 = $request->persyaratan1;
            $loker->persyaratan2 = $request->persyaratan2;
            $loker->persyaratan3 = $request->persyaratan3;
            $loker->persyaratan4 = $request->persyaratan4;

            $loker->created_by = 1;
            $loker->save();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Proses Input Berhasil", "Data telah disimpan");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Proses Input Gagal", "Proses input data gagal! " . $e);
        }
    }

    public static function do_update($id, Request $request)
    {
        // Proses validasi
  
        // Proses update
        try {
            DB::beginTransaction();

            // Proses cari data
            $loker = Loker::find($id);

            // Cek data ada di database
            if ($loker == null) return ResponseHelper::response_error("Proses Ubah Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $loker->judul = $request->judul;
            $loker->deskripsi1 = $request->deskripsi1;
            $loker->deskripsi2 = $request->deskripsi2;
            $loker->deskripsi3 = $request->deskripsi3;
            $loker->deskripsi4 = $request->deskripsi4;
            $loker->persyaratan1 = $request->persyaratan1;
            $loker->persyaratan2 = $request->persyaratan2;
            $loker->persyaratan3 = $request->persyaratan3;
            $loker->persyaratan4 = $request->persyaratan4;

            $loker->created_by = 1;
            $loker->save();

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
            $loker = Loker::find($id);

            // Cek data ada di database
            if ($loker == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $loker->delete();

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
