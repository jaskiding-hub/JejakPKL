<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\CeritaPKLController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminIndustriController;
use App\Http\Controllers\Admin\AdminCeritaController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Rute login dan registrasi untuk pengguna yang belum masuk
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Root selalu redirect ke login (walaupun sudah pernah login)
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk halaman utama dan fitur pengguna yang sudah login
Route::middleware('auth.any')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/industri/{id}', [IndustriController::class, 'detail'])->name('industri.detail');
    Route::get('/cerita-pkl/bagikan', [CeritaPKLController::class, 'create'])->name('cerita-pkl.create');
    Route::post('/cerita-pkl/bagikan', [CeritaPKLController::class, 'store'])->name('cerita-pkl.store');
});

// Rute admin dan pengelolaan data khusus admin
Route::get('/admin/login', function () { return redirect()->route('login'); })->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Tampilan dan aksi untuk manajemen data industri
    Route::get('/industri', [AdminIndustriController::class, 'index'])->name('industri');
    Route::get('/industri/tambah', [AdminIndustriController::class, 'create'])->name('industri.create');
    Route::post('/industri', [AdminIndustriController::class, 'store'])->name('industri.store');
    Route::get('/industri/{id}/edit', [AdminIndustriController::class, 'edit'])->name('industri.edit');
    Route::put('/industri/{id}', [AdminIndustriController::class, 'update'])->name('industri.update');
    Route::delete('/industri/{id}', [AdminIndustriController::class, 'destroy'])->name('industri.destroy');

    // Tampilan dan aksi untuk manajemen cerita PKL
    Route::get('/cerita', [AdminCeritaController::class, 'index'])->name('cerita');
    Route::get('/cerita/{id}/edit', [AdminCeritaController::class, 'edit'])->name('cerita.edit');
    Route::put('/cerita/{id}', [AdminCeritaController::class, 'update'])->name('cerita.update');
    Route::delete('/cerita/{id}', [AdminCeritaController::class, 'destroy'])->name('cerita.destroy');
});

// Rute API lokal untuk permintaan AJAX dari halaman pengguna
Route::middleware('auth.any')->group(function () {
    Route::get('/api/top-mitra', function () {
        return response()->json(
            \App\Models\Industri::orderBy('jumlah_siswa_pkl', 'desc')->paginate(3, ['*'], 'top_page')
        );
    });

    Route::get('/api/semua-mitra', function () {
        $search = request('search', '');
        $jurusan = request('jurusan', 'Semua Jurusan');
        $query = \App\Models\Industri::query();

        if ($search) {
            $query->where('nama_industri', 'like', "%$search%")
                ->orWhere('kategori', 'like', "%$search%");
        }
        if ($jurusan !== 'Semua Jurusan') {
            $query->where('kategori', $jurusan);
        }

        return response()->json($query->paginate(6));
    });
});
