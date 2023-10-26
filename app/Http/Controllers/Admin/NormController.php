<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNormRequest;
use App\Http\Requests\UpdateNormRequest;
use App\Models\Norm;

class NormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.norms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spiski.norms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Norm $norm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Norm $norm)
    {
        return view('admin.spiski.norms.edit', ['norm' => $norm]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNormRequest $request, Norm $norm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Norm $norm)
    {
        //
    }
}
