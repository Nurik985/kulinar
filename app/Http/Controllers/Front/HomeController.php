<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::where('fade_home', '=', 'true')->get();
        return view('front.home', ['sections' => $sections]);
    }
}
