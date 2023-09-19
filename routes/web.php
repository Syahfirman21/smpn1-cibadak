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


// Login
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');







// Search
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/search-redirect', [SearchController::class, 'searchRedirect'])->name('berita.search-redirect');


// admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [GlobalAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [GlobalAdminController::class, 'index'])->name('admin.dashboard');
    
    Route::resource('berita', BeritaController::class);
    Route::resource('agenda', AgendaAdminController::class);
    Route::resource('gallery', GalleryController::class);
    
    Route::post('gallery/addCategory', [GalleryController::class, 'addCategory'])->name('admin.gallery.addCategory');
    Route::resource('guru', GuruController::class);
    
    Route::prefix('ppdb')->group(function () {
        Route::get('/', [PpdbController::class, 'index'])->name('admin.ppdb.index');
        Route::get('/reguler', [PpdbController::class, 'index'])->name('admin.ppdb.regular');
        Route::post('/reguler', [PpdbController::class, 'postRegular'])->name('admin.ppdb.regular_dt');
        Route::get('/import', [PpdbController::class, 'import_form'])->name('admin.ppdb.import');
        Route::post('/import', [PpdbController::class, 'import_post'])->name('admin.ppdb.store');
        Route::post('/status/{id}', [PpdbController::class, 'ch_status'])->name('admin.ppdb.status');
        Route::delete('/{id}', [PpdbController::class, 'ppdb_delete'])->name('admin.ppdb.delete');
    });


// Page
Route::resource('pages', 'Admin\PageController');


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

});


 
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);





Route::get('admin/berita', 'AdminController@beritaIndex')->name('admin.berita.index');
Route::get('admin/agenda', 'AdminController@agendaIndex')->name('admin.agenda.index');
Route::get('admin/siswa', 'AdminController@siswaIndex')->name('admin.siswa.index');
Route::get('admin/saran', 'AdminController@saranIndex')->name('admin.saran.index');


Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('admin/berita/create', 'AdminController@beritaCreate')->name('admin.berita.create');
Route::get('admin/berita', 'AdminController@beritaIndex')->name('admin.berita.index');
Route::get('admin/agenda/create', 'AdminController@agendaCreate')->name('admin.agenda.create');
Route::get('admin/agenda', 'AdminController@agendaIndex')->name('admin.agenda.index');
Route::get('admin/ppdb/regular', 'AdminController@ppdbRegular')->name('admin.ppdb.regular');
Route::get('admin/gallery', 'AdminController@galleryIndex')->name('admin.gallery.index');
Route::get('admin/siswa', 'AdminController@siswaIndex')->name('admin.siswa.index');
Route::get('admin/guru', 'AdminController@guruIndex')->name('admin.guru.index');
Route::get('admin/pesan', 'AdminController@pesanIndex')->name('admin.pesan.index');
Route::get('admin/home/edit/{id}', 'AdminController@homeEdit')->name('admin.home.edit');
Route::get('admin/pages/edit/{pages}', 'AdminController@pagesEdit')->name('admin.pages.edit');
Route::get('admin/setting', 'AdminController@setting')->name('admin.setting');
