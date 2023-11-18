<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CalcController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
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
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\front\MainController;
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
    phpinfo();
    $bannerMenu = DB::table('categories')->select('content')->where('name', '=', 'bannerMenu')->first();
    $row_sea = '';
    if(!empty($bannerMenu)){
        $menu = json_decode($bannerMenu->content, true);
//        $itemArr = [];
//        foreach ($menu as $k => $item) {
//            $itemArr = array_merge($itemArr, array_keys($menu[$k]['selecteds']));
//        }
//
//        $headings = DB::table('headings')->whereIn('id', $itemArr)->orderBy('name', 'ASC')->get()->toArray();

        foreach ($menu as $key => $item) {
            foreach ($item['selecteds'] as $k => $selected) {
                //echo $selected."<br>";
                $headings = DB::table('headings')->where('id', '=', $k)->first();
                if(!empty($headings->parent_bread)){

                    $parent_bread = json_decode($headings->parent_bread,true);
                    $parent_bread_id = $parent_bread[0];
                    $parent_sect = json_decode($headings->parent_sect,true);
                    $parent_sect_id = $parent_sect[0];

                    $parent_bread = DB::table('headings')->where('id', '=', $parent_bread_id)->first();
                    $parent_sect = DB::table('sections')->where('id', '=', $parent_sect_id)->first();
                    $newLocation   = "/".$parent_sect->url."/".$parent_bread->url."/".$headings->url."/";

                }else{
                    $parent_sect = json_decode($headings->parent_sect,true);
                    $parent_sect_id = $parent_sect[0];
                    $parent_sect = DB::table('sections')->where('id', '=', $parent_sect_id)->first();
                    $newLocation   = "/".$parent_sect->url."/".$headings->url."/";
                }

                echo $newLocation."<br>";
            }
        }
    }



//    echo "<pre>";
//    print_r($menu);
//    echo "</pre>";

});

Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => ['auth', 'auth.session']], function () {
    Route::view('/', 'admin.index')->name('admin');

    Route::resource('razdel', SectionController::class);
    Route::resource('rubricator', CategoryController::class);
    Route::resource('redirects', RedirectController::class);
    Route::resource('recipe', RecipeController::class);
    Route::resource('pages', PageController::class);
    Route::resource('comments', CommentController::class);
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

Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/{any?}', [MainController::class, 'index'])
    ->where('any', '^(?!(api|captcha|password|files)\/?)[\/\w\.-]*');
