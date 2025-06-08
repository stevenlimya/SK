<?php
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\ApprovCutiController;
use App\Http\Controllers\ApprovIzinController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PermintaanKaryawanController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\SanksiController;
use App\Http\Controllers\ResainController;
use App\Http\Controllers\LaporanController;
use App\Http\Middleware\Karyawan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/FrontPage", [FrontPageController::class, "index"]);
Route::get("/noaccess", [FrontPageController::class, "noaccess"]);

// untuk  menangani halaman login, proses login dan logout dalam aplikasi
Route::get("/login", [AuthController::class, "login"])->name("loginpage");
Route::post("/auth/login", [AuthController::class, "do_login"]);
Route::get("/logout", [AuthController::class, "logout"]);

// fungsi untuk mengecek apakah pengguna telah login sebelum dapat mangakes rute-rute dalam grup ini
Route::middleware(["auth.session"])->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name('dashboard.index');

// grup yang berisi rute-rute untuk mengelola data master
    // Master Data
    Route::group(["prefix" => "master"], function () {

// setiap grup ini berisi rute-rute untuk menampilkan, membuat, mengedit , menyimpan, memperbarui dan menghapus entitas dalam
// kategori data master yang terkait.
        // Master Data Akun
        Route::group(["prefix" => "user", "as" => "master.user"], function () {
            Route::get("/create", [UserController::class, "create"])->middleware('HRD');
            Route::get("/", [UserController::class, "index"])->middleware('HRD');
            Route::get("/edit/{id}", [UserController::class, "edit"])->middleware('HRD');
            Route::post("/store", [UserController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [UserController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [UserController::class, "destroy"])->middleware('HRD');
        });

        // Master Data Absen
        Route::group(["prefix" => "absen", "as" => "master.absen"], function () {
            Route::get("/", [AbsenController::class, "index"])->middleware('HRD');
            Route::post("/import", [AbsenController::class, "import"])->middleware('HRD');
            Route::post("/delete/{id}", [AbsenController::class, "destroy"])->middleware('HRD');
        });

        // Master Data Laporan
        Route::group(["prefix" => "laporan", "as" => "master.laporan"], function () {
            Route::get("/", [LaporanController::class, "index"])->middleware('Direktur');
            Route::post('/export', [LaporanController::class, 'exportReport'])->middleware('Direktur');
        });
        // Master Data Karyawan
        Route::group(["prefix" => "karyawan", "as" => "master.karyawan"], function () {
            Route::get("/", [KaryawanController::class, "index"])->middleware('HRD');
            Route::get("/create", [KaryawanController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [KaryawanController::class, "edit"])->middleware('HRD');
            Route::post("/store", [KaryawanController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [KaryawanController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [KaryawanController::class, "destroy"])->middleware('HRD');
            Route::get("/view/{id}", [KaryawanController::class, "view"])->middleware('HRD');
            Route::get("/getdata/{id}", [KaryawanController::class, "getdata"])->middleware('HRD');
        });
        // Master Data Permintaan Karyawan
        Route::group(["prefix" => "permintaankaryawan", "as" => "master.permintaankaryawan"], function () {
            Route::get("/", [PermintaanKaryawanController::class, "index"])->middleware('HRD');
            Route::get("/create", [PermintaanKaryawanController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [PermintaanKaryawanController::class, "edit"])->middleware('HRD');
            Route::post("/store", [PermintaanKaryawanController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [PermintaanKaryawanController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [PermintaanKaryawanController::class, "destroy"])->middleware('HRD');
            Route::get("/view/{id}", [PermintaanKaryawanController::class, "view"])->middleware('HRD');
            Route::get("/getdata/{id}", [PermintaanKaryawanController::class, "getdata"])->middleware('HRD');
        });
        // Master Data Cuti
        Route::group(["prefix" => "cuti", "as" => "master.cuti"], function () {
            Route::get("/", [CutiController::class, "index"])->middleware('KaryawanHRD');
            Route::get("/create", [CutiController::class, "create"])->middleware('KaryawanHRD');
            Route::get("/edit/{id}", [CutiController::class, "edit"])->middleware('KaryawanHRD');
            Route::post("/store", [CutiController::class, "store"])->middleware('KaryawanHRD');
            Route::post("/update/{id}", [CutiController::class, "update"])->middleware('KaryawanHRD');
            Route::post("/delete/{id}", [CutiController::class, "destroy"])->middleware('KaryawanHRD');
            Route::get("/getdata/{id}", [CutiController::class, "getdata"])->middleware('KaryawanHRD');
        });
        // Master Data Izin
        Route::group(["prefix" => "izin", "as" => "master.izin"], function () {
            Route::get("/", [IzinController::class, "index"])->middleware('KaryawanHRD');
            Route::get("/create", [IzinController::class, "create"])->middleware('KaryawanHRD');
            Route::get("/edit/{id}", [IzinController::class, "edit"])->middleware('KaryawanHRD');
            Route::post("/store", [IzinController::class, "store"])->middleware('KaryawanHRD');
            Route::post("/update/{id}", [IzinController::class, "update"])->middleware('KaryawanHRD');
            Route::post("/delete/{id}", [IzinController::class, "destroy"])->middleware('KaryawanHRD');
            Route::get("/getdata/{id}", [IzinController::class, "getdata"])->middleware('KaryawanHRD');
        });
        // Master Data Approval Cuti
        Route::group(["prefix" => "approvcuti", "as" => "master.approvcuti"], function () {
            Route::get("/", [ApprovCutiController::class, "index"])->middleware('HRD');
            Route::get("/edit/{id}", [ApprovCutiController::class, "edit"])->middleware('HRD');
            Route::post("/store", [ApprovCutiController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [ApprovCutiController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [ApprovCutiController::class, "destroy"])->middleware('HRD');
        });
        // Master Data Approval Izin
        Route::group(["prefix" => "approvizin", "as" => "master.approvizin"], function () {
            Route::get("/", [ApprovIzinController::class, "index"])->middleware('HRD');
            Route::get("/edit/{id}", [ApprovIzinController::class, "edit"])->middleware('HRD');
            Route::post("/store", [ApprovIzinController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [ApprovIzinController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [ApprovIzinController::class, "destroy"])->middleware('HRD');
        });
        // Master Data Loker
        Route::group(["prefix" => "loker", "as" => "master.loker"], function () {
            Route::get("/", [LokerController::class, "index"])->middleware('HRD');
            Route::get("/create", [LokerController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [LokerController::class, "edit"])->middleware('HRD');
            Route::post("/store", [LokerController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [LokerController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [LokerController::class, "destroy"])->middleware('HRD');
        });
        // Master Data Pelamar
        Route::group(["prefix" => "pelamar", "as" => "master.pelamar"], function () {
            Route::get("/", [PelamarController::class, "index"])->middleware('HRD');
            Route::get("/create", [PelamarController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [PelamarController::class, "edit"])->middleware('HRD');
            Route::get("/download/{id}", [PelamarController::class, "download"])->middleware('HRD');
            Route::post("/store", [PelamarController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [PelamarController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [PelamarController::class, "destroy"])->middleware('HRD');
            Route::get("/view/{id}", [PelamarController::class, "view"])->middleware('HRD');
        });
        // Master Data Resain
        Route::group(["prefix" => "resain", "as" => "master.resain"], function () {
            Route::get("/", [ResainController::class, "index"])->middleware('HRD');
            Route::get("/create", [ResainController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [ResainController::class, "edit"])->middleware('HRD');
            Route::post("/store", [ResainController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [ResainController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [ResainController::class, "destroy"])->middleware('HRD');
            Route::get("/getdata/{id}", [ResainController::class, "getdata"])->middleware('HRD');
        });
        // Master Data Reward
        Route::group(["prefix" => "reward", "as" => "master.reward"], function () {
            Route::get("/", [RewardController::class, "index"])->middleware('HRD');
            Route::get("/create", [RewardController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [RewardController::class, "edit"])->middleware('HRD');
            Route::post("/store", [RewardController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [RewardController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [RewardController::class, "destroy"])->middleware('HRD');
            Route::get("/getdata/{id}", [RewardController::class, "getdata"])->middleware('HRD');
        });
        // Master Data Sanksi
        Route::group(["prefix" => "sanksi", "as" => "master.sanksi"], function () {
            Route::get("/", [SanksiController::class, "index"])->middleware('HRD');
            Route::get("/create", [SanksiController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [SanksiController::class, "edit"])->middleware('HRD');
            Route::post("/store", [SanksiController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [SanksiController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [SanksiController::class, "destroy"])->middleware('HRD');
            Route::get("/getdata/{id}", [SanksiController::class, "getdata"])->middleware('HRD');
        });
         // Master Data Divisi
         Route::group(["prefix" => "divisi", "as" => "master.divisi"], function () {
            Route::get("/", [DivisiController::class, "index"])->middleware('HRD');
            Route::get("/create", [DivisiController::class, "create"])->middleware('HRD');
            Route::get("/edit/{id}", [DivisiController::class, "edit"])->middleware('HRD');
            Route::post("/store", [DivisiController::class, "store"])->middleware('HRD');
            Route::post("/update/{id}", [DivisiController::class, "update"])->middleware('HRD');
            Route::post("/delete/{id}", [DivisiController::class, "destroy"])->middleware('HRD');
        });        
    });
    // Route::group(["prefix" => "stock"], function () {
    //     Route::group(["prefix" => "opname", "as" => "stock.opname"], function () {
    //         Route::get("/", [StockOpnameController::class, "index"]);
    //         Route::get("/create", [StockOpnameController::class, "create"]);
    //         Route::get("/edit/{id}", [StockOpnameController::class, "edit"]);
    //         Route::post("/store", [StockOpnameController::class, "store"]);
    //         Route::post("/update/{id}", [StockOpnameController::class, "update"]);
    //         Route::post("/delete/{id}", [StockOpnameController::class, "destroy"]);
    //     });

    //     Route::group(["prefix" => "incoming", "as" => "stock.incoming"], function () {
    //         Route::get("/", [IncomingStockController::class, "index"]);
    //         Route::get("/create", [IncomingStockController::class, "create"]);
    //         Route::get("/edit/{id}", [IncomingStockController::class, "edit"]);
    //         Route::post("/store", [IncomingStockController::class, "store"]);
    //         Route::post("/update/{id}", [IncomingStockController::class, "update"]);
    //         Route::post("/delete/{id}", [IncomingStockController::class, "destroy"]);
    //     });

    //     Route::group(["prefix" => "outgoing", "as" => "stock.outgoing"], function () {
    //         Route::get("/", [OutgoingStockController::class, "index"]);
    //         Route::get("/create", [OutgoingStockController::class, "create"]);
    //         Route::get("/edit/{id}", [OutgoingStockController::class, "edit"]);
    //         Route::post("/store", [OutgoingStockController::class, "store"]);
    //         Route::post("/update/{id}", [OutgoingStockController::class, "update"]);
    //         Route::post("/delete/{id}", [OutgoingStockController::class, "destroy"]);
    //     });

    //     Route::group(["prefix" => "view", "as" => "stock.view"], function () {
    //         Route::get("/", [StockViewController::class, "index"]);
    //         Route::get("/detail/{id}", [StockViewController::class, "detail"]);
    //     });
    // });
});
