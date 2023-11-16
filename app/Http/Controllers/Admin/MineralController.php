<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMineralRequest;
use App\Http\Requests\UpdateMineralRequest;
use App\Models\Mineral;

class MineralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.minerals.index');
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
    public function store(StoreMineralRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mineral $mineral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mineral $mineral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMineralRequest $request, Mineral $mineral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mineral $mineral)
    {
        //
    }
}
