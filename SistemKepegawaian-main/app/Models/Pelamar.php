<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;

class Pelamar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "pelamar";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi

    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'nama' => 'required'
        ]);

        // Proses input
        try {
            DB::beginTransaction();
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/pelamar', $fileName); // Simpan file di storage/app/public/pelamar

            // Proses Input data
            $pelamar = new Pelamar;
            $pelamar->nama = $request->nama;
            $pelamar->divisi = $request->divisi;
            $pelamar->jeniskelamin = $request->jeniskelamin;
            $pelamar->alamat = $request->alamat;
            $pelamar->tanggallahir = $request->tanggallahir;
            $pelamar->notelepon = $request->notelepon;
            $pelamar->nik = $request->nik;
            $pelamar->email = $request->email;
            $pelamar->file = $fileName;
            // $pelamar->filepath = $filePath;
            // $pelamar->filetype = $file->getClientMimeType();

            $pelamar->created_by = 1;
            $pelamar->save();

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
        ]);
        // Proses update
        try {
            DB::beginTransaction();
            // $file = $request->file('file');
            // $fileName = time() . '_' . $file->getClientOriginalName();
            // $filePath = $file->storeAs('public/pelamar', $fileName); // Simpan file di storage/app/public/pelamar

            // Proses cari data
            $pelamar = Pelamar::find($id);

            // Cek data ada di database
            if ($pelamar == null) return ResponseHelper::response_error("Proses Ubah Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $pelamar->nama = $request->nama;
            $pelamar->divisi = $request->divisi;
            $pelamar->jeniskelamin = $request->jeniskelamin;
            $pelamar->alamat = $request->alamat;
            $pelamar->tanggallahir = $request->tanggallahir;
            $pelamar->notelepon = $request->notelepon;
            $pelamar->nik = $request->nik;
            $pelamar->email = $request->email;
            // $pelamar->file = $fileName;
            // $pelamar->filepath = $filePath;
            // $pelamar->filetype = $file->getClientMimeType();
            $pelamar->created_by = 1;
            $pelamar->save();

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
            $pelamar = Pelamar::find($id);

            // Cek data ada di database
            if ($pelamar == null) return ResponseHelper::response_error("Proses Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $pelamar->delete();

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
