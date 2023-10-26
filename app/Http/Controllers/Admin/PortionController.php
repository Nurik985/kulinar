<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortionRequest;
use App\Http\Requests\UpdatePortionRequest;
use App\Models\Portion;

class PortionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.portions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spiski.portions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Portion $portion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portion $portion)
    {
        return view('admin.spiski.portions.edit', ['portion' => $portion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortionRequest $request, Portion $portion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portion $portion)
    {
        //
    }
}
