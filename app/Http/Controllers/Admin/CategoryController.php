<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Heading;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Heading::findOrFail(4690);

        $row_search = '';

        if ($result->type == 1) {

            $items = $result->ingredients_accept;
            $no_items = $result->ingredients_block;
            $w_k =  $result->w_cook;
            $method = $result->cooking_m;

            $items = str_replace('/', '', $items);
            $items = str_replace('|', '', $items);

            $items = explode(' и ', $items);
            $no_items = explode(' и ', $no_items);
            $w_k = explode(' и ', $w_k);
            $method = explode(' и ', $method);

            $res = DB::table('recipes');

            if (!empty($items)) {
                foreach ($items as $key => $value) {
                    $value = explode(' или ', $value);

                    if (!empty($value[0])) {

                        $res->where(function ($query) use ($value){
                            foreach ($value as $key1 => $value1) {
                                $value1 = preg_replace('/или (.*)/', '$1', $value1);
                                $value1 = preg_replace('/и (.*)/', '$1', $value1);
                                $value1 = str_replace('/', '', $value1);
                                $value1 = str_replace('|', '', $value1);
                                $value1 = trim($value1);
                                if ($key1 == 0) {
                                    $query->where('ingridients', 'like', '%'.$value1.'%');
                                } else {
                                    $query->orWhere('ingridients', 'like', '%'.$value1.'%');
                                }
                            }
                        });
                    }
                }
            }

            if (!empty($no_items)) {
                foreach ($no_items as $key => $value) {
                    $value = explode(' или ', $value);

                    if (!empty($value[0])) {

                        $res->where(function ($query) use ($value){
                            foreach ($value as $key1 => $value1) {
                                $value1 = preg_replace('/или (.*)/', '$1', $value1);
                                $value1 = preg_replace('/и (.*)/', '$1', $value1);
                                $value1 = str_replace('/', '', $value1);
                                $value1 = str_replace('|', '', $value1);
                                $value1 = trim($value1);

                                if ($key1 == 0) {
                                    $query->where('ingridients', 'not like', '%'.$value1.'%');
                                } else {
                                    $query->orWhere('ingridients', 'not like', '%'.$value1.'%');
                                }
                            }
                        });
                    }
                }
            }

            if (!empty($w_k[0])) {
                foreach ($w_k as $key => $value) {
                    $value = explode(' или ', $value);

                    if (!empty($value[0])) {

                        $res->where(function ($query) use ($value){
                            foreach ($value as $key1 => $value1) {
                                $value1 = preg_replace('/или (.*)/', '$1', $value1);
                                $value1 = preg_replace('/и (.*)/', '$1', $value1);
                                $value1 = str_replace('/', '', $value1);
                                $value1 = str_replace('|', '', $value1);
                                $value1 = trim($value1);

                                if ($key1 == 0) {
                                    $query->where('w_cook', 'like', '%'.$value1.'%');
                                } else {
                                    $query->orWhere('w_cook', 'like', '%'.$value1.'%');
                                }
                            }
                        });
                    }
                }
            }

            if (!empty($method[0])) {
                foreach ($method as $key => $value) {
                    $value = explode(' или ', $value);

                    if (!empty($value[0])) {

                        $res->where(function ($query) use ($value){
                            foreach ($value as $key1 => $value1) {
                                $value1 = preg_replace('/или (.*)/', '$1', $value1);
                                $value1 = preg_replace('/и (.*)/', '$1', $value1);
                                $value1 = str_replace('/', '', $value1);
                                $value1 = str_replace('|', '', $value1);
                                $value1 = trim($value1);

                                if ($key1 == 0) {
                                    $query->where('method', 'like', '%'.$value1.'%');
                                } else {
                                    $query->orWhere('method', 'like', '%'.$value1.'%');
                                }
                            }
                        });
                    }
                }
            }

            $query = $res->select('id', 'status')->toRawSql();
            dd($query);

            $col_recipe = $res->select('id', 'status')->get();
            $col_public_recipe = $col_recipe->where('status', '=', 1);
            $arr_recipe = $col_public_recipe->pluck('id');

            echo $col_recipe->count();
            echo "<br>";
            echo $col_public_recipe->count();
            echo "<br>";
            echo json_encode($arr_recipe);
//            echo "<pre>";
//            print_r($arr_recipe);
//            echo "</pre>";
            die();
            //$result2 = $res->where('status', '=', 1)->count();
        }
        return view("admin.categories.index", ['result1' => $result1, 'result2' => $result2]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
