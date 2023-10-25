<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\KitchenController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\HeadingController;
use App\Http\Controllers\Admin\IngredientController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";});

Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => ['auth', 'auth.session']], function () {
  Route::view('/', 'admin.index')->name('admin');

  Route::resource('razdel', SectionController::class);

  Route::resource('spisok/ings', IngredientController::class, ['as' => 'spisok']);
  Route::resource('spisok/kitchen', KitchenController::class, ['as' => 'spisok']);

  Route::get('rubrica', [HeadingController::class, 'index'])->name('rubrica.index');
  Route::post('rubrica', [HeadingController::class, 'store'])->name('rubrica.store');
  Route::get('rubrica/{id}/edit', [HeadingController::class, 'edit'])->name('rubrica.edit');
  Route::put('rubrica/{id}', [HeadingController::class, 'update'])->name('rubrica.update');
  Route::delete('rubrica/{id}', [HeadingController::class, 'destroy'])->name('rubrica.destroy');

  Route::view('rubrica/param', 'admin.headings.param-create')->name('rubrica.param-create');
  Route::view('rubrica/manual', 'admin.headings.manual-create')->name('rubrica.manual-create');

  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
