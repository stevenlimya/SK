<?php

namespace App\Models;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Izin extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "izin";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi');
    }
    
    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'nama' => 'required',
            'divisi' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'lama' => 'required'
        ]);

        // Proses input
        try {
            DB::beginTransaction();

            // Proses Input data
            $izin = new Izin;
            $izin->karyawan_id = $request->karyawan_id;
            $izin->nama = $request->nama;
            $izin->divisi = $request->divisi;
            $izin->status = $request->status;
            $izin->keterangan = $request->keterangan;
            $izin->tanggal = $request->tanggal;
            $izin->lama = $request->lama;
            $izin->acc = $request->acc;

            $izin->created_by = 1;
            $izin->save();

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
            $izin = Izin::find($id);

            // Cek data ada di database
            if ($izin == null) return ResponseHelper::response_error("Proses Ubah Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $izin->nama = $request->nama;
            $izin->divisi = $request->divisi;
            $izin->status = $request->status;
            $izin->keterangan = $request->keterangan;
            $izin->tanggal = $request->tanggal;
            $izin->lama = $request->lama;
            $izin->acc = $request->acc;

            $izin->created_by = 1;
            $izin->save();

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
            $izin = Izin::find($id);

            // Cek data ada di database
            if ($izin == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $izin->delete();

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
