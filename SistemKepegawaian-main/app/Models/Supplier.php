<?php

namespace App\Models;

use App\Helpers\ResponseHelper;
use App\Helpers\UploadFilePathHelper;
use App\Helpers\UserInfoHelper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "suppliers";

    // [MANUAL CHECKLIST]
    // Cek input, cek ubah, cek hapus
    // Cek siapa yang input, ubah, hapus
    // Cek kesesuaian data yang diinput dengan kolom tabel yang diisi

    public static function do_store(Request $request)
    {
        // Proses validasi
        $request->validate([
            'name' => 'required',
        ]);

        // Proses input
        try {
            DB::beginTransaction();

            // Proses Input data
            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            

            $supplier->created_by = 1;
            $supplier->save();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Input Berhasil", "Data Tersimpan");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Input Gagal", "Data tidak tersimpan! " . $e);
        }
    }

    public static function do_update($id, Request $request)
    {
        // Proses validasi
        $request->validate([
            'name' => 'required',
        ]);

        // Proses update
        try {
            DB::beginTransaction();

            // Proses cari data
            $supplier = Supplier::find($id);

            // Cek data ada di database
            if ($supplier == null) return ResponseHelper::response_error("Update Gagal", "Data tidak ditemukan");

            // Jika ada, lanjut update data
            $supplier->name = $request->name;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;

            $supplier->created_by = 1;
            $supplier->save();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Update Berhasil", "Data terupdate");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Update", "Update gagal");
        }
    }

    public static function do_delete($id)
    {
        try {
            DB::beginTransaction();

            // Proses Input data
            $supplier = Supplier::find($id);

            // Cek data ada di database
            if ($supplier == null) return ResponseHelper::response_error("Hapus Gagal", "Data tidak ditemukan");

            // Jika ada, input data yang hapus
            $supplier->delete();

            // Setelah input / ubah data lakukan commit agar perubahan tersimpan di database
            DB::commit();
            return ResponseHelper::response_success("Hapus Berhasil", "Data terhapus");
        } catch (Exception $e) {
            // Jika terjadi kesalahan waktu input, lakukan aksi rollback sehingga data tidak tersimpan
            DB::rollBack();
            return ResponseHelper::response_error("Hapus Gagal", "Hapus data gagal!");
        }
    }
}
