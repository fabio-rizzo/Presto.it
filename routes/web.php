<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;


// Auth::routes(['verify' => true]);

//! middleware('auth')
Route::get('account/announcement/create',[AnnouncementController::class, 'create'])->middleware(['auth' , 'verified'])->name('announcement.create');

//------edit annuncio livewire
Route::get('/users', function(){
    return view('account.announcement.editAnnouncement');
})->name('announcement.edit');

//------Richiesta Revisore
Route::get('/richiesta/revisore', [RevisorController::class,'becomeRevisor'])->middleware(['auth' , 'verified'])->name('become.revisor');

Route::resource('announcement', AnnouncementController::class)->middleware(['auth' , 'verified']);





//! middleware('admin')
Route::get('account/admin',[AdminController::class, 'index'])->middleware(['auth' , 'verified'])->name('admin.index');

/* route::get('account/admin', function(){
    $adminList = App\Models\User::where('role', 'admin')->get();
    return view('admin.index', compact('adminList'));
})->name('admin.index'); */




//! middleware('isRevisor')
//----Home Revisore
Route::get('/revisor/home', [RevisorController::class,'index'])->middleware(['auth' , 'verified','isRevisor'])->name('revisor.index');

//----Rotta per accettare annuncio
Route::patch('/accetta/annuncio/{announcement}', [RevisorController::class,'acceptAnnouncement'])->middleware(['auth' , 'verified','isRevisor'])->name('revisor.accept_announcement');//-Metodo "patch" per eseguire una modifica singola e non l'intero elemento

//-----Rotta per rifiutare annuncio
Route::patch('/rifiuta/annuncio/{announcement}', [RevisorController::class,'rejectAnnouncement'])->middleware(['auth' , 'verified','isRevisor'])->name('revisor.reject_announcement');

Route::patch('/elimina/annuncio/{announcement}', [RevisorController::class,'destroyAnnouncement'])->middleware(['auth' , 'verified','isRevisor'])->name('revisor.destroy_announcement');





//! senza middleware
Route::get('/', [FrontController::class, 'home'])->name('home');

Route::get('/categoria/{category}', [FrontController::class, 'categoryShow'])->name('categoryShow');

//----visualizza tutti gli annunci di un dedermiantop utente
Route::get('/user/page/announcements/{user}', [FrontController::class, 'announcementUserShow'])->name('announcementUserShow');

Route::get('/dettaglio/annuncio/{announcement}', [AnnouncementController::class,'showAnnouncement'])->name('announcements.show');

//------Rendi Revisore
Route::get('/rendi/revisore/{user}', [RevisorController::class,'makeRevisor'])->name('make.revisor');

//------Ricerca Annuncio
Route::get('/ricerca/annuncio', [FrontController::class,'searchAnnouncements'])->name('announcements.search');

//------Cambio Lingua
Route::post('/lingua/{lang}', [FrontController::class, 'setLanguage'])->name('set_language_locale');

