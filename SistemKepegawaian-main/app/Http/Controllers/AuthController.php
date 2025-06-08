<?php

//Mengimpor kelas dan penggunaan namespace
//mengimpor kelas-kelas yang diperlukan
namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Helpers\UserInfoHelper;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

// merupakan kelas dasar untuk semua pengontrol dalam Laravel.
class AuthController extends Controller
{ //Fungsi ini menampilkan halaman login dengan mengembalikan tampilan pages.auth.login.
    public function login() {
        return view('pages.auth.login');
    }
    //untuk memproses proses login yang diajukan oleh pengguna lalu diperiksa
    //apakah pengguna dengan username yang diberikan ada dalam basis data.
    public function do_login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        $user = User::where("username", "=", $username)->first();

        // Jika username ditemukan
        if ($user != null) {
            if (!empty($user[0]->deleted_at)) {
                return response()->json([
                    "code" => -1,
                    "response" => [
                        'type'      => 'error',
                        'title'     => 'Login gagal!',
                        'message'   => 'Akun tidak dapat diakses'
                    ]
                ]);
            }

        //     // Jika password yang diinput sama
            if (FacadesHash::check($password, $user->password)) {

                // Waktu saat ini < waktu logout yg akan datang
                if ($user->logout_time != null && Carbon::now()->lt($user->logout_time)) {
                    // Jika akun yg login dengan ip yang beda
                    // if ($user->web_ip != null && $user->web_ip != UserInfoHelper::get_user_ip()) {
                    //     return response()->json([
                    //         "code" => -1,
                    //         "response" => [
                    //             'type'      => 'error',
                    //             'title'     => 'Akun sedang digunakan',
                    //             'message'   => 'Harap coba kembali dalam beberapa waktu'
                    //         ]
                    //     ]);
                    // }
                }
                //berfungsi untuk mengupdate informasi pengguna setelah berhasil login
                $user = User::find($user->id);
                $user->web_ip = UserInfoHelper::get_user_ip(); // Ini digunakan untuk menyimpan alamat IP pengguna yang sedang login. 
                $user->logout_time = Carbon::now()->addMinutes(15); //menggunakan nilai waktu saat ini ditambah 15 menit
                $user->save();//menyimpan perubahan yang dilakukan pada objek pengguna ke basis data dengan menggunakan metode save
                
                $request->session()->put('user', $user);

                return response()->json([
                    "code" => 200,
                    "response" => [
                        'type'      => 'success',
                        'title'     => 'Login Berhasil!',
                        'message'   => 'Kamu akan segera dialihkan ke halaman utama'
                    ]
                ]);
            }
        }

        return response()->json([
            "code" => -1,
            "response" => [
                'type'      => 'error',
                'title'     => 'Login gagal!',
                'message'   => 'Username atau password salah.'
            ]
        ]);
    }
//menghapus informasi pengguna dari sesi dan mengarahkan pengguna kembali ke halaman login
//Dalam contoh kode yang diberikan, AuthController bertanggung jawab untuk menampilkan halaman login, memproses login, dan logout dalam aplikasi.
    public function logout(Request $request) {
        $user = User::withTrashed()->find(UserInfoHelper::user_id());
        $user->save();
        $request->session()->forget('user');
        return redirect('/login');
    }
    
}
