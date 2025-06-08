<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;

class Reward extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "reward";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi

    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'nama' => 'required',
            'divisi' => 'required',
            'reward' => 'required'
        ]);

        // Proses input
        try {
            DB::beginTransaction();

            // Proses Input data
            $reward = new Reward;
            $reward->karyawan_id = $request->karyawan_id;
            $reward->nama = $request->nama;
            $reward->divisi = $request->divisi;
            $reward->reward = $request->reward;
            $reward->tanggal = $request->tanggal;

            $reward->created_by = 1;
            $reward->save();

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
        $request->validate([
            'nama' => 'required',
            'divisi' => 'required',
            'reward' => 'required'
        ]);
  
        // Proses update
        try {
            DB::beginTransaction();

            // Proses cari data
            $reward = Reward::find($id);

            // Cek data ada di database
            if ($reward == null) return ResponseHelper::response_error("Proses Ubah Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $reward->nama = $request->nama;
            $reward->divisi = $request->divisi;
            $reward->reward = $request->reward;
            $reward->tanggal = $request->tanggal;

            $reward->created_by = 1;
            $reward->save();

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
            $reward = Reward::find($id);

            // Cek data ada di database
            if ($reward == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $reward->delete();

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
