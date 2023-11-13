<?php

use App\Models\Heading;
use App\Models\Recipe;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\DB;

function forceRecipe($id): void
{
    $result = Heading::findOrFail($id);

    $col_public_recipe = 0;
    $col_recipe = 0;
    $arr_recipe = [];

    $row_search = false;

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
                    $row_search = true;
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
                    $row_search = true;
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
                    $row_search = true;
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
                    $row_search = true;
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

        if($row_search){
            $col_recipe = $res->select('id', 'status')->get();
            $col_public_recipe = $col_recipe->where('status', '=', 1);
            $arr_recipe = $col_public_recipe->pluck('id');
            $col_recipe = $col_recipe->count();
            $col_public_recipe = $col_public_recipe->count();
        }

        $arr_recipe = json_encode($arr_recipe);

    } elseif ($result->type == 2) {
        $recipe_all = json_decode($result->recept, true);
        if (!empty($recipe_all)) {
            $arr_recipe = $result->recept;
            $col_recipe = count($recipe_all);
            $col_public = DB::table('recipes')->select("id","status")->whereIn('id', $recipe_all)->where('status', 1)->get();
            $col_public_recipe = count($col_public);
        }
    }

    DB::table('headings')->where('id', $id)->update(['col_recipe' => $col_recipe, 'col_public_recipe' => $col_public_recipe, 'recept' => $arr_recipe]);
}

function forceRecipeAll($recipeId): void
{
    $recipe = (array) DB::table('recipes')->where('id', '=', $recipeId)->first();

    if(!empty($recipe)){
        $arr = [];
        $update_arr = [];
        $arrLikes = [];

        $headings = DB::table('headings')->where('type', '=', 1)->get();

        $updateData = [];

        foreach ($headings as  $heading) {
            $res = arrayCostomSearch($recipe, json_decode($heading->genzapros, 1));
            if ($res == 'true') {
                if (!empty($heading->recept)) {
                    $headingRecept = json_decode($heading->recept, true);
                } else {
                    $headingRecept = [];
                }

                if (!empty($headingRecept)) {

                    if (!in_array($recipeId, $headingRecept)) {
                        array_push($headingRecept, $recipeId);
                        if ($recipe['status'] == 1) {
                            $col_public_recipe = $heading->col_public_recipe + 1;
                        } else {
                            $col_public_recipe = $heading->col_public_recipe;
                        }
                        $updateData[$heading->id]['col_public_recipe'] = $col_public_recipe;
                    }

                    $updateData[$heading->id]['recept'] = $headingRecept;
                }
            } elseif ($res == 'false' or $recipe['status'] == 4) {
                if (!empty($heading->recept)) {
                    $headingRecept = json_decode($heading->recept, true);
                } else {
                    $headingRecept = [];
                }

                if (!empty($headingRecept)) {
                    if (!in_array($recipeId, $headingRecept)) {
                        unset($headingRecept[array_search($recipeId, $headingRecept)]);

                        if ($recipe['status'] == 1) {
                            $col_public_recipe = $heading->col_public_recipe - 1;
                        } else {
                            $col_public_recipe = $heading->col_public_recipe;
                        }
                        $updateData[$heading->id]['col_public_recipe'] = $col_public_recipe;
                    }

                    $updateData[$heading->id]['recept'] = $headingRecept;
                }
            }
        }

        $i = 0;
        foreach ($updateData as $key => $value) {
            $updateRow[$i]['id'] = $key;
            if(!empty($value['col_public_recipe'])){
                $updateRow[$i]['col_public_recipe'] = $value['col_public_recipe'];
            }
            if (!empty($value['recept'])) {
                $col_recipe = count($value['recept']);
            } else {
                $col_recipe = 0;
            }
            $updateRow[$i]['col_recipe'] = $col_recipe;
            $updateRow[$i]['recept'] =  json_encode($value['recept']);
            $i++;
        }

        batch()->update(new Heading, $updateRow, 'id');
    }
}

function arrayCostomSearch($recipe, $arrLikeVal){

    $col = count($arrLikeVal);
    $col_row = 0;
    $not_like = 0;

    foreach ($arrLikeVal as $itemsKey => $items) {
        $or = 0;
        foreach ($items as $itemKey => $item) {
            $item = trim($item);

            if (stripos($item, 'NOT LIKE')) {
                $item = explode('NOT LIKE', $item);
                $item[1] = str_replace('"', '', $item[1]);
                $item[1] = str_replace('%', '', $item[1]);

                $item[0] = mb_strtolower(trim($item[0]));
                $item[1] = mb_strtolower(trim($item[1]));

                if (stripos($recipe[$item[0]], $item[1]) !== false) {
                    $not_like = 1;
                } else {
                    $col_row++;
                }
            } else {
                $item = explode('LIKE', $item);
                $item[1] = str_replace('"', '', $item[1]);
                $item[1] = str_replace('%', '', $item[1]);
                $item[0] = mb_strtolower(trim($item[0]));
                $item[1] = mb_strtolower(trim($item[1]));

                if (stripos(mb_strtolower($recipe[$item[0]]), $item[1]) !== false && $or == 0) {
                    $or = 1;
                    $col_row++;
                }
            }
        }
    }

    if ($not_like == 1) {
        return('false');
    } elseif ($col == $col_row) {
        return('true');
    } else {
        return('false');
    }

}

function array_first($array, $default = null)
{
    foreach ($array as $item) {
        return $item;
    }
    return $default;
}

function genZapros($items, $no_items, $w_k, $method){
    $newData = [];
    $row_search = '';

    $items = str_replace('/', '', $items);
    $items = str_replace('|', '', $items);

    $items = explode(' и ', $items);
    $no_items = explode(' и ', $no_items);
    $w_k = explode(' и ', $w_k);
    $method = explode(' и ', $method);

    if (!empty($items)) {
        foreach ($items as $key => $value) {
            $value = explode(' или ', $value);

            if (!empty($value[0])) {
                $newEl = [];
                if (empty($row_search)) {
                    $group =
                    $row_search = 'WHERE (';
                } else {
                    $row_search .= ' and (';
                }

                foreach ($value as $key1 => $value1) {
                    $value1 = preg_replace('/или (.*)/', '$1', $value1);
                    $value1 = preg_replace('/и (.*)/', '$1', $value1);
                    $value1 = str_replace('/', '', $value1);
                    $value1 = str_replace('|', '', $value1);
                    $value1 = trim($value1);

                    if ($key1 == 0) {
                        $row_search .= 'ingridients LIKE "%' . $value1 . '%"';
                    } else {
                        $row_search .= ' OR ingridients LIKE "%' . $value1 . '%"';
                    }
                    $newEl[] = 'ingridients LIKE '. $value1;
                }

                $row_search .= ')';
                if(!empty($newEl)){
                    $newData[] = $newEl;
                }
            }
        }
    }

    if (!empty($no_items)) {
        foreach ($no_items as $key => $value) {
            $value = explode(' или ', $value);

            if (!empty($value[0])) {
                $newEl = [];
                if (empty($row_search)) {
                    $row_search = 'WHERE (';
                } else {
                    $row_search .= ' and (';
                }

                foreach ($value as $key1 => $value1) {
                    $value1 = preg_replace('/или (.*)/', '$1', $value1);
                    $value1 = preg_replace('/и (.*)/', '$1', $value1);
                    $value1 = str_replace('/', '', $value1);
                    $value1 = str_replace('|', '', $value1);
                    $value1 = trim($value1);

                    if ($key1 == 0) {
                        $row_search .= 'ingridients NOT LIKE "%' . $value1 . '%"';
                    } else {
                        $row_search .= ' OR ingridients NOT LIKE "%' . $value1 . '%"';
                    }

                    $newEl[] = 'ingridients NOT LIKE '. $value1;
                }

                $row_search .= ')';
                if(!empty($newEl)){
                    $newData[] = $newEl;
                }
            }
        }
    }

    if (!empty($w_k[0])) {
        foreach ($w_k as $key => $value) {
            $value = explode(' или ', $value);

            if (!empty($value[0])) {
                $newEl = [];
                if (empty($row_search)) {
                    $row_search = 'WHERE (';
                } else {
                    $row_search .= ' and (';
                }

                foreach ($value as $key1 => $value1) {
                    $value1 = preg_replace('/или (.*)/', '$1', $value1);
                    $value1 = preg_replace('/и (.*)/', '$1', $value1);
                    $value1 = str_replace('/', '', $value1);
                    $value1 = str_replace('|', '', $value1);
                    $value1 = trim($value1);

                    if ($key1 == 0) {
                        $row_search .= 'w_cook LIKE "%' . $value1 . '%"';
                    } else {
                        $row_search .= ' OR w_cook LIKE "%' . $value1 . '%"';
                    }

                    $newEl[] = 'w_cook LIKE '. $value1;
                }

                $row_search .= ')';
                if(!empty($newEl)){
                    $newData[] = $newEl;
                }
            }
        }
    }

    if (!empty($method[0])) {
        foreach ($method as $key => $value) {
            $value = explode(' или ', $value);

            if (!empty($value[0])) {
                $newEl = [];
                if (empty($row_search)) {
                    $row_search = 'WHERE (';
                } else {
                    $row_search .= ' and (';
                }

                foreach ($value as $key1 => $value1) {
                    $value1 = preg_replace('/или (.*)/', '$1', $value1);
                    $value1 = preg_replace('/и (.*)/', '$1', $value1);
                    $value1 = str_replace('/', '', $value1);
                    $value1 = str_replace('|', '', $value1);
                    $value1 = trim($value1);

                    if ($key1 == 0) {
                        $row_search .= 'method LIKE "%' . $value1 . '%"';
                    } else {
                        $row_search .= ' OR method LIKE "%' . $value1 . '%"';
                    }

                    $newEl[] = 'method LIKE '. $value1;
                }

                $row_search .= ')';
                if(!empty($newEl)){
                    $newData[] = $newEl;
                }
            }
        }
    }

    return $newData;

}

function filter_mas($arr){
    if(count($arr)>0){
        foreach ($arr as $key => $value) {
            if(empty($value)) unset($arr[$key]); else $arr[$key] = htmlspecialchars($value);
        }
        if(!empty($arr)) $arr = json_encode($arr); else $arr='';
    } else {
        $arr='';
    };
    return $arr;
}
