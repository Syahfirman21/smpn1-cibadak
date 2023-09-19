<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;


use App\Http\Controllers\Admin\GlobalAdminController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\AgendaAdminController;
use App\Http\Controllers\Admin\GuruController;

use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'store']);

Route::middleware(['web'])->prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('{id}/{title}', [BlogController::class, 'show']);
});

Route::prefix('ppdb')->group(function () {
    Route::get('/waiting', function () {
        return view('themes.ppdb.waiting');
    })->name('ppdb.waiting');

    Route::get('/', [PpdbController::class, 'index']);

    Route::middleware(['ppdb'])->group(function () {
        Route::get('/download/attachments', [PpdbController::class, 'download'])->name('ppdb.attachments');
        Route::get("/daftar", [PpdbController::class, 'daftar'])->name("ppdb.daftar_form");
        Route::post("/daftar", [PpdbController::class, 'daftarPost'])->name("ppdb.daftar_post");
        Route::get("/result", [PpdbController::class, 'regular'])->name("ppdb.prestasi");
        Route::get("/daftar/success/{token}", [PpdbController::class, 'success'])->name("ppdb.success");
        Route::post("/cek-hasil", [PpdbController::class, 'result'])->name("ppdb.result");
        Route::post("/upload/attachments", [PpdbController::class, 'uploads_attachments'])->name("ppdb.upload.atachments");
    });
});




Route::get('contact', [ContactController::class, 'index']);
Route::post('contact', [ContactController::class, 'store']);
Route::get('agenda/{id}/{title}', [AgendaController::class, 'show']);
Route::get('guru', [TeacherController::class, 'index']);
Route::get('guru/{id}', [TeacherController::class, 'show']);
Route::get('siswa/{class_id}/{kelas}', [StudentController::class, 'index']);
Route::get('about', [HomeController::class, 'aboutIndex']);
Route::get('gallery', [GalleryController::class, 'mainIndex']);
Route::get('gallery/{kategori}', [GalleryController::class, 'galCat'])->name('galeri.kategori');
Route::get('page/{role}', [PageController::class, 'show']);
Route::get('gallery/{kategori}/{img}', [GalleryController::class, 'showImg'])->name('galeri.kategori.img');




// route minimize image
Route::get('image/minimize/{img}', ['as'=>'minimize.image', function($img) {
	$imgMinimize = Image::make(public_path('upload/'.$img));
	$imgMinimize->resize(400, null, function($constraint) {
		$constraint->aspectRatio();
	});
	return $imgMinimize->response('jpg', 30);
}]);



// admin

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [GlobalAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/home/edit/{id}', [GlobalAdminController::class, 'editHome'])->name('admin.home.edit');
    Route::post('/home/update/{id}', [GlobalAdminController::class, 'updateHome'])->name('admin.home.update');

    Route::get('/setting', [GlobalAdminController::class, 'settingSite'])->name('admin.setting');
    Route::post('/setting/link', [GlobalAdminController::class, 'updateLink'])->name('admin.setting.link');
    Route::post('/setting/password', [GlobalAdminController::class, 'updatePass'])->name('admin.setting.password');
});




// Authentication routes...
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');



Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/search-redirect', [SearchController::class, 'searchRedirect'])->name('berita.search-redirect');





    


// Rute untuk sumber daya 'pages' (CRUD pages)
Route::resource('pages', PageController::class);



		


// Siswa
Route::middleware(['auth'])->group(function () {
    Route::get('siswa/{id}/edit', [StudentController::class, 'edit'])->name('admin.siswa.editSiswa');
    Route::patch('siswa/{id}', [StudentController::class, 'update'])->name('admin.siswa.update');
    Route::get('siswa', [StudentController::class, 'index'])->name('admin.siswa.index');
    Route::delete('siswa/{id}/{kelas}', [StudentController::class, 'destroyAll'])->name('admin.siswa.destroyAll');
    Route::get('siswa/{id}/{kelas}', [StudentController::class, 'tampil'])->name('admin.kelas.tampil');
    Route::get('siswa/import', [StudentController::class, 'importIndex'])->name('admin.siswa.importIndex');
    Route::post('siswa/imported', [StudentController::class, 'import'])->name('admin.siswa.import');
    Route::delete('siswa/{id}/{kelas}/{class_id}', [StudentController::class, 'destroy'])->name('admin.siswa.destroy');
    
    Route::post('siswa-redirect', [StudentController::class, 'siswaRedirect'])->name('admin.siswa-redirect');
});


 
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);