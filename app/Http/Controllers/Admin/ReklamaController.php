<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReklamaController extends Controller
{
    public function index()
    {
        return view('admin.reklama.index');
    }
}
