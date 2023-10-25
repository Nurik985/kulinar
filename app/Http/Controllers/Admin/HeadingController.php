<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.headings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function paramCreate()
    {
        return view('admin.headings.param-create');
    }

    public function manualCreate()
    {
        return view('admin.headings.manual-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeadingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Heading $heading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Heading $heading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeadingRequest $request, Heading $heading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Heading $heading)
    {
        //
    }
}
