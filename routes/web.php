<?php
//* Controlleurs de Laravel
use Illuminate\Support\Facades\Route;
//* Controlleur Scraper
use App\Http\Controllers\ScraperController;
//* Controlleur Sprint0
use App\Http\Controllers\Sprint0Controller;
//* Controlleurs Normaux
use App\Http\Controllers\UserController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\BouteillePersonnaliseeController;
//* Controlleurs Admin
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCellierController;
use App\Http\Controllers\AdminBouteilleController;
use App\Http\Controllers\AdminBouteillePersonnaliseeController;
//* Relatif a Breeze
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//* SECTION SCRAPER
Route::prefix('scraper')->name('scraper.')->group(function () {
    Route::get('/', [ScraperController::class, 'index'])->name('index');
    Route::get('/welcome', [ScraperController::class, 'welcome'])->name('welcome');
    Route::get('/keywords', [ScraperController::class, 'keywords'])->name('keywords');
    Route::get('/codes', [ScraperController::class, 'codes'])->name('codes');
    Route::get('/liste', [ScraperController::class, 'liste'])->name('liste');
});

//* SECTION SPRINT0
Route::get('/sprint0', [Sprint0Controller::class, 'demoListe'])->name('sprint0.liste');

//* SECTION ADMIN 
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::resource('bouteilles', AdminBouteilleController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('celliers', AdminCellierController::class);
    Route::resource('bouteilles_personnalisees', AdminBouteillePersonnaliseeController::class);
});

//* SECTION APPLICATION DEEZ_WINES
Route::resource('bouteilles', BouteilleController::class);
Route::resource('users', UserController::class);
Route::resource('celliers', CellierController::class);
Route::resource('bouteilles_personnalisees', BouteillePersonnaliseeController::class);
