<?php

namespace App\Http\Controllers\Admin;

use App\Models\Method;
use App\Http\Requests\StoreMethodRequest;
use App\Http\Requests\UpdateMethodRequest;
use App\Http\Controllers\Controller;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.methods.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spiski.methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMethodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Method $method)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Method $method)
    {
        return view('admin.spiski.methods.edit', ['method' => $method]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMethodRequest $request, Method $method)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Method $method)
    {
        //
    }
}
