<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalcRequest;
use App\Http\Requests\UpdateCalcRequest;
use App\Models\Calc;

class CalcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.spiski.calc.index');
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
    public function store(StoreCalcRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calc $calc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calc $calc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalcRequest $request, Calc $calc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calc $calc)
    {
        //
    }
}
