<?php

use App\Http\Controllers\Admin\SaranPesanController;
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
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Admin\GlobalAdminController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\AgendaAdminController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
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
Route::get('search/{keyword}', 'SearchController@search')->name('search');
Route::post('/search-redirect',[SearchController::class,'search'])->name('berita.search-redirect');





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
    Route::get('siswa/import', [AdminStudentController::class, 'importIndex'])->name('admin.siswa.importIndex');
    Route::post('siswa/imported', [StudentController::class, 'import'])->name('admin.siswa.import');
    Route::delete('siswa/{id}/{kelas}/{class_id}', [StudentController::class, 'destroy'])->name('admin.siswa.destroy');
    
    Route::post('siswa-redirect', [AdminStudentController::class, 'siswaRedirect'])->name('admin.siswa-redirect');
});

});


 
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);





Route::get('admin/berita',[BeritaController::class,'index']);
Route::get('admin/agenda', [AgendaAdminController::class,'store'])->name('admin.agenda.store');
Route::get('admin/siswa', 'AdminController@siswaIndex')->name('admin.siswa.index');
Route::get('admin/saran', 'AdminController@saranIndex')->name('admin.saran.index');


Route::group(['prefix' => 'admin'], function () {
    Route::get('berita/index', 'AdminController@beritaIndex')->name('admin.berita.index');
    Route::get('agenda/index', 'AdminController@agendaIndex')->name('admin.agenda.index');
    Route::get('siswa/index', 'AdminController@siswaIndex')->name('admin.siswa.index');
    Route::get('saran/index', 'AdminController@saranIndex')->name('admin.saran.index');
});



Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    
// Admin Berita
    Route::prefix('berita')->group(function () {
        Route::get('create', [BeritaController::class ,'create'])->name('admin.berita.create');
        Route::post('berita/store', [BeritaController::class, 'store'])->name('admin.berita.store');
        Route::get('berita/store', [BeritaController::class, 'store'])->name('admin.berita.store');
       
    });
    

    // Admin Agenda
    Route::prefix('agenda')->group(function () {
        Route::get('create',[AgendaAdminController::class,'create'])->name('admin.agenda.create');
        Route::post('store',[AgendaAdminController::class,'store'] ) ->name('admin.agenda.store');
    });

   


    
   Route::group(['prefix' => 'admin'], function () {
    // ... Route lainnya di dalam group admin ...

    // Definisi route untuk PpdbController
    Route::get('ppdb', [PpdbController::class, 'index'])->name('admin.ppdb.index');
    Route::get('ppdb/import', [PpdbController::class, 'import_form'])->name('admin.ppdb.import');
    Route::post('ppdb/import', [PpdbController::class, 'import_post'])->name('admin.ppdb.import.post');
    Route::get('ppdb/status/{id}', [PpdbController::class, 'ch_status'])->name('admin.ppdb.status');
    Route::post('ppdb/regular', [PpdbController::class, 'postRegular'])->name('admin.ppdb.regular');
    Route::get('ppdb/delete/{id}', [PpdbController::class, 'ppdb_delete'])->name('admin.ppdb.delete');

    // ... Route lainnya di dalam group admin ...
});
    
   

    
    Route::get('siswa/index', [AdminStudentController::class,'index'])->name('admin.siswa.index');



// Admin Gallery
    Route::get('admin/gallery',[AdminGalleryController::class,'index'])->name('admin.gallery.index');
    Route::post('/gallery/store', [AdminGalleryController::class, 'storeGallery'])->name('admin.gallery.store');
    Route::delete('/admin/gallery/{id}',[AdminGalleryController::class,'destroy'])->name('admin.gallery.destroy');
    Route::post('/your/route/url',[AdminGalleryController::class,''])->name('route_name');
    Route::post('/admin/gallery/store', [AdminGalleryController::class, 'show'])->name('admin.gallery.shows');



    Route::get('guru/index',[AdminGuruController::class,'index'])->name('admin.guru.index');
    
    Route::prefix('pesan')->group(function () {
        Route::get('index',[SaranPesanController::class,'index'])->name('admin.pesan.index');
    });
    
    Route::get('home/edit/{id}', 'HomeController@edit')->name('admin.home.edit');
    
    Route::prefix('pages')->group(function () {
        Route::get('edit/{pages}', 'PagesController@edit')->name('admin.pages.edit');
    });
    
    Route::get('setting', 'SettingController@index')->name('admin.setting');
});



// Route::prefix('admin')->group(function () {
//     Route::get('dashboard', [GlobalAdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('berita/create', [GlobalAdminController::class, 'beritaCreate'])->name('admin.berita.create');
//     Route::get('berita', [BeritaController::class, 'index'])->name('admin.berita.index');
//     Route::get('agenda/create', [GlobalAdminController::class, 'agendaCreate'])->name('admin.agenda.create');
//     Route::get('agenda', [GlobalAdminController::class, 'agendaIndex'])->name('admin.agenda.index');
//     Route::get('ppdb/regular', [GlobalAdminController::class, 'ppdbRegular'])->name('admin.ppdb.regular');
//     Route::get('gallery', [GlobalAdminController::class, 'galleryIndex'])->name('admin.gallery.index');
//     Route::get('siswa', [GlobalAdminController::class, 'siswaIndex'])->name('admin.siswa.index');
//     Route::get('guru', [GuruController::class, 'index'])->name('admin.guru.index');
//     Route::get('pesan', [GlobalAdminController::class, 'pesanIndex'])->name('admin.pesan.index');
//     Route::get('home/edit/{id}', [GlobalAdminController::class, 'homeEdit'])->name('admin.home.edit');
//     // Route::get('pages/edit/{pages}', [GlobalAdminController::class, 'pagesEdit'])->name('admin.pages.edit');
//     Route::get('setting', [GlobalAdminController::class, 'setting'])->name('admin.setting');
// });


Route::prefix('admin')->group(function () {
    Route::get('dashboard', [GlobalAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('home/edit/{id}', [GlobalAdminController::class, 'editHome'])->name('admin.home.edit');
    Route::post('home/update/{id}', [GlobalAdminController::class, 'updateHome'])->name('admin.home.update');
    Route::get('setting', [GlobalAdminController::class, 'settingSite'])->name('admin.setting');
    Route::post('setting/update-link', [GlobalAdminController::class, 'updateLink'])->name('admin.setting.update-link');
    Route::post('setting/update-password', [GlobalAdminController::class, 'updatePass'])->name('admin.setting.update-password');
});

Route::prefix('admin')->group(function () {
    // Rute untuk menangani permintaan POST dari formulir
    Route::post('setting/update-link', [GlobalAdminController::class, 'updateLink'])->name('admin.setting.updateLink');
    Route::post('setting/update-password', [GlobalAdminController::class, 'updatePass'])->name('admin.setting.updatePass');
});



Route::prefix('admin')->group(function () {
    // Rute untuk mengedit halaman berdasarkan 'pages' yang diberikan
    Route::get('pages/edit/{pages}', [AdminPageController::class, 'index'])->name('admin.pages.edit');

    // Rute untuk mengedit halaman Sambutan Kepala
    Route::get('pages/edit/sambutan', [AdminPageController::class, 'edit'])->name('admin.pages.edit.sambutan');

    // Rute untuk mengedit halaman Profil Kepala Sekolah
    Route::get('pages/edit/kepalaSekolah', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.kepalaSekolah');

    // Rute untuk mengedit halaman About Page
    Route::get('pages/edit/about', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.about');

    // Rute untuk mengedit halaman Profil Page
    Route::get('pages/edit/profil', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.profil');

    // Rute untuk mengedit halaman Visi Misi Page
    Route::get('pages/edit/visiMisi', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.visiMisi');

    // Rute untuk mengedit halaman Organisasi Page
    Route::get('pages/edit/organisasi', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.organisasi');

    // Rute untuk mengedit halaman Ekstrakulikuler Page
    Route::get('pages/edit/ekskul', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.ekskul');

    // Rute untuk mengedit halaman Fasilitas Page
    Route::get('pages/edit/fasilitas', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.fasilitas');

    // Rute untuk mengedit halaman Prestasi Page
    Route::get('pages/edit/prestasi', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.prestasi');

    // Rute untuk mengedit halaman Jadwal Pelajaran Page
    Route::get('pages/edit/jadwalPelajaran', [AdminController::class, 'pagesEdit'])->name('admin.pages.edit.jadwalPelajaran');

    // Rute untuk menghandle permintaan PATCH dari formulir edit home
    Route::patch('home/update/{id}', [GlobalAdminController::class, 'updateHome'])->name('admin.home.update');
});

Route::patch('/admin/setting/updatePass',[GlobalAdminController::class,'updatePass'])->name('admin.setting.updatePass');

