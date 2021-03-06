<?php
use Illuminate\Http\Request;
use App\Buku;
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

Route::get('/', function () {
    $programKeahlian     = \DB::table('buku')->where('kategori_id',"=",4)->get();
    $fiksi               = \DB::table('buku')->where('kategori_id',"=",3)->get();
    $nonFiksi            = \DB::table('buku')->where('kategori_id',"=",2)->get();
    $referensi           = \DB::table('buku')->where('kategori_id',"=",1)->get();
    $berita              = \DB::table('berita')->get();
        
    return view('welcome') 
        ->with('programKeahlian',$programKeahlian) 
        ->with('fiksi',$fiksi)
        ->with('nonFiksi',$nonFiksi)
        ->with('referensi',$referensi)
        ->with('berita',$berita);
});

Route::get('/non-fiksi', function () {
    $nonFiksi      = \DB::table('buku')->where('kategori_id',"=",2)->orderBy('created_at','desc')->get();
    
    return view('non-fiksi')  
        ->with('nonFiksi',$nonFiksi);
});
Route::get('/fiksi', function () {
    $fiksi          = \DB::table('buku')->where('kategori_id',"=",3)->orderBy('created_at','desc')->get();
    
    return view('fiksi')  
        ->with('fiksi',$fiksi);
});
Route::get('/referensi', function () {
    $referensi          = \DB::table('buku')->where('kategori_id',"=",1)->orderBy('created_at','desc')->get();
    
    return view('referensi')  
        ->with('referensi',$referensi);
});
Route::get('/program-keahlian', function () {
    $programKeahlian    = \DB::table('buku')->where('kategori_id',"=",4)->orderBy('created_at','desc')->get();
    
    return view('program-keahlian')  
        ->with('programKeahlian',$programKeahlian);
});
Route::get('/cari',function(Request $request){
    $title = $request->title;
    $chKategori = $request->chKategori;
    $cariBuku = Buku::where('kategori_id',"=",$chKategori);
    if($title){
        $cariBuku = $cariBuku->where('judul','like','%' .$title.'%')->orWhere('pengarang','like','%' .$title. '%')->get();
    }
    else{
        $cariBuku = $cariBuku->get();
    }
    return view('search',['cariBuku'=>$cariBuku]);
});

Route::get('/detail-berita', function(){
    return view('detail-berita');
});

Route::get('/detail-berita/{id}', 'BeritaController@detail');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');
Route::get('/user-edit/{id}', 'UserController@edit');
*/
Route::resource('user', 'UserController');

Route::resource('anggota', 'AnggotaController');

Route::resource('buku', 'BukuController');
Route::get('/format_buku', 'BukuController@format');
Route::post('/import_buku', 'BukuController@import');

Route::resource('transaksi', 'TransaksiController');
Route::get('/laporan/trs', 'LaporanController@transaksi');
Route::get('/laporan/trs/pdf', 'LaporanController@transaksiPdf');
Route::get('/laporan/trs/excel', 'LaporanController@transaksiExcel');

Route::get('/laporan/buku', 'LaporanController@buku')->name('laporan');
Route::get('/laporan/buku/pdf', 'LaporanController@bukuPdf');
Route::get('/laporan/buku/excel', 'LaporanController@bukuExcel');

//Telegram
Route::resource('telegram','TelegramBotController');
Route::get('/updated-activity','TelegramBotController@updatedActivity');
Route::get('/message-telegram','TelegramBotController@indexTelegram');
Route::post('/send-message','TelegramBotController@storeMessage');
Route::get('/send-photo', 'TelegramBotController@sendPhoto');
Route::post('/store-photo', 'TelegramBotController@storePhoto');
Route::post('/send-announce','TelegramBotController@storeAnnounce')->name('pilihBuku');

//Berita
Route::get('/berita','BeritaController@index');
Route::get('/berita/tambah','BeritaController@tambah');
Route::post('/berita/upload','BeritaController@upload');

Route::get('/berita/hapus/{id}','BeritaController@hapus');
Route::get('/berita/edit/{id}','BeritaController@edit');
Route::post('/berita/update/','BeritaController@update');


