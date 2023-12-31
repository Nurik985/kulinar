<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use Illuminate\View\View;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.ingredients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spiski.ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIngredientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ing) : View
    {
        return view('admin.spiski.ingredients.edit', ['ing' => $ing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request, Ingredient $ing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ing)
    {
        //
    }
}
