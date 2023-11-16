<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CalcController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CookController;
use App\Http\Controllers\Admin\HeadingController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\KitchenController;
use App\Http\Controllers\Admin\MethodController;
use App\Http\Controllers\Admin\MineralController;
use App\Http\Controllers\Admin\NormController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PortionController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\RedirectController;
use App\Http\Controllers\Admin\ReklamaController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UnitController;
use App\Models\Calc;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});


Route::get('stest', function () {
    $calcs = Calc::all()->toArray();

    $res = 'return [' . PHP_EOL;
    foreach ($calcs as $key => $result) {
        $res .= '[' . PHP_EOL;
        if ($result['id'] != '') {
            $res .= "'id' => " . "'" . $result['id'] . "'," . PHP_EOL;
        }
        if ($result['ing_id'] != '') {
            $res .= "'ing_id' => '" . $result['ing_id'] . "'," . PHP_EOL;
        }
        if ($result['datas'] != '') {
            $res .= "'datas' => '" . $result['datas'] . "'," . PHP_EOL;
        }
        $res .= '],' . PHP_EOL;
    }
    $res .= '];';
    echo "<pre>";
    print_r($res);
    echo "</pre>";
//    foreach ($headings as $k => $heading) {
//        echo $k+1 .' - ' .$heading['name']."<br>";
//    }
});

Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => ['auth', 'auth.session']], function () {
    Route::view('/', 'admin.index')->name('admin');

    Route::resource('razdel', SectionController::class);
    Route::resource('rubricator', CategoryController::class);
    Route::resource('redirects', RedirectController::class);
    Route::resource('recipe', RecipeController::class);
    Route::resource('pages', PageController::class);
    Route::get('reklama', [ReklamaController::class, 'index'])->name('reklama');
    Route::view('message', 'admin.messages.index')->name('messages');
    Route::post('recipe/upload', [RecipeController::class, 'upload'])->name('ckeditor.upload');

    Route::resource('spisok/ings', IngredientController::class, ['as' => 'spisok']);
    Route::resource('spisok/kitchen', KitchenController::class, ['as' => 'spisok']);
    Route::resource('spisok/method', MethodController::class, ['as' => 'spisok']);
    Route::resource('spisok/cook', CookController::class, ['as' => 'spisok']);
    Route::resource('spisok/units', UnitController::class, ['as' => 'spisok']);
    Route::resource('spisok/portions', PortionController::class, ['as' => 'spisok']);
    Route::resource('spisok/norms', NormController::class, ['as' => 'spisok']);
    Route::resource('spisok/authors', AuthorController::class, ['as' => 'spisok']);
    Route::resource('spisok/calc', CalcController::class, ['as' => 'spisok']);
    Route::resource('spisok/minerals', MineralController::class, ['as' => 'spisok']);


    Route::get('rubrica', [HeadingController::class, 'index'])->name('rubrica.index');
    Route::post('rubrica', [HeadingController::class, 'store'])->name('rubrica.store');
    Route::get('rubrica/{id}/edit', [HeadingController::class, 'edit'])->name('rubrica.edit');
    Route::put('rubrica/{id}', [HeadingController::class, 'update'])->name('rubrica.update');
    Route::delete('rubrica/{id}', [HeadingController::class, 'destroy'])->name('rubrica.destroy');

    Route::view('rubrica/param', 'admin.headings.param-create')->name('rubrica.param-create');
    Route::view('rubrica/manual', 'admin.headings.manual-create')->name('rubrica.manual-create');

    Route::post('/get-rubrics', [HeadingController::class, 'getRubrics'])->name('get-rubrics');
    Route::post('/get-sections', [HeadingController::class, 'getSections'])->name('get-sections');
    Route::post('/get-cooks', [HeadingController::class, 'getCooks'])->name('get-cooks');
    Route::post('/get-ingredients', [HeadingController::class, 'getIngredients'])->name('get-ingredients');
    Route::post('/get-methods', [HeadingController::class, 'getMethods'])->name('get-methods');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
