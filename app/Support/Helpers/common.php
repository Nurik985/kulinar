<?php

use App\Models\Heading;
use Illuminate\Support\Facades\DB;

function forceRecipe($id){
    $result = Heading::findOrFail($id);

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

        $col_recipe = $res->select('id', 'status')->get();
        $col_public_recipe = $col_recipe->where('status', '=', 1);
        $arr_recipe = $col_public_recipe->pluck('id');
        $col_recipe = $col_recipe->count();
        $col_public_recipe = $col_public_recipe->count();
        $arr_recipe = json_encode($arr_recipe);

    } elseif ($result->type == 2) {
        $recipe_all = json_decode($result->recept, true);
        if (!empty($recipe_all)) {
            $col_recipe = count($recipe_all);
            $query = DB::table('recipes')->select("id","status")->whereIn('id', $recipe_all)->where('status', 1)->get();
        }
    }

    DB::table('headings')->where('id', $id)->update(['col_recipe' => $col_recipe, 'col_public_recipe' => $col_public_recipe, 'recept' => $arr_recipe]);
}

function array_first($array, $default = null)
{
    foreach ($array as $item) {
        return $item;
    }
    return $default;
}

if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
            mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
