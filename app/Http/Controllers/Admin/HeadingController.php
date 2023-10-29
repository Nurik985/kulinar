<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getRubrics(Request $request)
    {
        $res = [];
        $results = '';
        if ($request->has('search')) {
            $search = $request->search;
            $res = DB::table('headings')->select("id","name")->where('name','LIKE',"%$search%")->limit(30)->get();
        }

        if($res){
            foreach ($res as $r) {
                $results .= '<li class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
            }
        }

        echo $results;
    }

    public function getSections(Request $request)
    {
        $res = [];
        $results = '';
        if ($request->has('search')) {
            $search = $request->search;
            $res = DB::table('sections')->select("id","h1")->where('h1','LIKE',"%$search%")->limit(30)->get();
        }

        if($res){
            foreach ($res as $r) {
                $results .= '<li class="py-1 px-2" id="' . $r->id . '">' . $r->h1 . '</li>';
            }
        }

        echo $results;
    }

//    public function getRubrics(Request $request)
//    {
//        $res = [];
//
//        if ($request->has('name')) {
//            $search = $request->name;
//            //$data = Heading::select("id","name")->where('name','LIKE',"%$search%")->get();
//            $res = DB::table('headings')->select("id","name")->whereNotIn('id', json_decode($request->remove, 1))->where('name','LIKE',"%$search%")->orderBy('name', 'ASC')->limit(50)->get();
//
//        }
//        return response()->json($res);
//    }

//    public function getSections(Request $request)
//    {
//        $res = [];
//
//        if ($request->has('name')) {
//            $search = $request->name;
//            $res = DB::table('sections')->select("id","h1")->whereNotIn('id', json_decode($request->remove, 1))->where('h1','LIKE',"%$search%")->orderBy('h1', 'ASC')->limit(50)->get();
//        }
//        return response()->json($res);
//    }

    public function getCooks(Request $request)
    {
        $res = [];

        if ($request->has('name')) {
            $search = $request->name;
            $res = DB::table('cooks')->select("id","name")->whereNotIn('id', json_decode($request->remove, 1))->where('name','LIKE',"%$search%")->orderBy('name', 'ASC')->limit(50)->get();
        }
        return response()->json($res);
    }

    public function getIngredients(Request $request)
    {
        $res = [];

        if ($request->has('name')) {
            $search = $request->name;
            $res = DB::table('ingredients')->select("id","name")->whereNotIn('id', json_decode($request->remove, 1))->where('name','LIKE',"%$search%")->orderBy('name', 'ASC')->limit(50)->get();
        }
        return response()->json($res);
    }

    public function getMethods(Request $request)
    {
        $res = [];

        if ($request->has('name')) {
            $search = $request->name;
            $res = DB::table('methods')->select("id","name")->whereNotIn('id', json_decode($request->remove, 1))->where('name','LIKE',"%$search%")->orderBy('name', 'ASC')->limit(50)->get();
        }
        return response()->json($res);
    }
}
