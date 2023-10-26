<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cook;
use App\Http\Requests\StoreCookRequest;
use App\Http\Requests\UpdateCookRequest;
use App\Http\Controllers\Controller;

class CookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.cooks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spiski.cooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cook $cook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cook $cook)
    {
        return view('admin.spiski.cooks.edit', ['cook' => $cook]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCookRequest $request, Cook $cook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cook $cook)
    {
        //
    }
}
