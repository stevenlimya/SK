<?php

namespace App\Models;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermintaanKaryawan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "permintaan_karyawan";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi
    
    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'pemohon' => 'required',
            'divisi_pemohon' => 'required'
        ]);

        // Proses input
        try {
            DB::beginTransaction();

            // Proses Input data
            $permintaan_karyawan = new PermintaanKaryawan;
            $permintaan_karyawan->karyawan_id = $request->karyawan_id;
            $permintaan_karyawan->pemohon = $request->pemohon;
            $permintaan_karyawan->divisi_pemohon = $request->divisi_pemohon;
            $permintaan_karyawan->keterangan = $request->keterangan;
            $permintaan_karyawan->divisi = $request->divisi;
            $permintaan_karyawan->tanggal = $request->tanggal;

            $permintaan_karyawan->created_by = 1;
            $permintaan_karyawan->save();

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
            $permintaan_karyawan = PermintaanKaryawan::find($id);

            // Cek data ada di database
            if ($permintaan_karyawan == null) return ResponseHelper::response_error("Proses Ubah Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $permintaan_karyawan->pemohon = $request->pemohon;
            $permintaan_karyawan->divisi_pemohon = $request->divisi_pemohon;
            $permintaan_karyawan->keterangan = $request->keterangan;
            $permintaan_karyawan->divisi = $request->divisi;
            $permintaan_karyawan->tanggal = $request->tanggal;

            $permintaan_karyawan->created_by = 1;
            $permintaan_karyawan->save();

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
            $permintaan_karyawan = PermintaanKaryawan::find($id);

            // Cek data ada di database
            if ($permintaan_karyawan == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $permintaan_karyawan->delete();

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
