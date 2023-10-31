<?php

namespace App\Livewire\Headings;

use App\Models\Heading;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeadingsEditParam extends Component
{
    use WithFileUploads;

    public $id;

    protected function rules()
    {
        return [
            'url' => 'required|min:3|regex:/^[a-zA-Z1-9-]+$/u|unique:' . Heading::class . ',url,' . $this->id,
            'title' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'Пожалуйста заполните обязательное поле',
            'url.min' => 'Название должен содержать мин 3 символа',
            'url.regex' => 'URL должен содержать только латиницу',
            'title.required' => 'Пожалуйста заполните обязательное поле',
            'name.required' => 'Пожалуйста заполните обязательное поле',
        ];
    }

    public $name;
    public $title;
    public $url;

    public $parentRub = [];
    public $parentSec = [];
    public $parentBread = [];
    public $firstText;
    public $lastText;
    public $cook = [];
    public $incIngr = [];
    public $excIngr  = [];
    public $method = [];
    public $fadeMenu;
    public $linkAddSection;
    public $storedImage;

    public $rubImg;

    public $rubricSearchText = '';
    public $rubricSearchResults = '';
    public $rubricSelecteds = [];
    public $rubricSearchRemoveIds = [];

    public $sectionSearchText = '';
    public $sectionSearchResults = '';
    public $sectionSelecteds = [];
    public $sectionSearchRemoveIds = [];

    public $breadcrumbSearchText = '';
    public $breadcrumbSearchResults = '';
    public $breadcrumbSelecteds = [];
    public $breadcrumbSearchRemoveIds = [];

    public $cookSearchText = '';
    public $cookSearchResults = '';
    public $cookSelecteds = [];
    public $cookSearchRemoveIds = [];
    public $cookShow = false;
    public $cookCheck;

    public $incIngrSearchText = '';
    public $incIngrSearchResults = '';
    public $incIngrSelecteds = [];
    public $incIngrSearchRemoveIds = [];
    public $incIngrShow = false;
    public $incIngrCheck;

    public $excIngrSearchText = '';
    public $excIngrSearchResults = '';
    public $excIngrSelecteds = [];
    public $excIngrSearchRemoveIds = [];
    public $excIngrShow = false;
    public $excIngrCheck;

    public $methodSearchText = '';
    public $methodSearchResults = '';
    public $methodSelecteds = [];
    public $methodSearchRemoveIds = [];
    public $methodShow = false;
    public $methodCheck;

    public $temporaryUrl = false;

    public function mount($headingId)
    {
        $this->id = $headingId;
        $heading = Heading::findOrFail($headingId);
        $this->name = $heading->name;
        $this->title = $heading->title;
        $this->url = $heading->url;

        $parentRubs = json_decode($heading->parent);
        if($parentRubs){
            $parentRubs = DB::table('headings')->select("id","name")->whereIn('id', $parentRubs)->get();
            foreach ($parentRubs as $parentRub) {
                $this->rubricSelecteds[$parentRub->id] = $parentRub->name;
                $this->parentRub[$parentRub->id] = $parentRub->id;
            }
        }

        $parentSecs = json_decode($heading->parent_sect);
        if($parentSecs){
            $parentSecs = DB::table('sections')->select("id","h1")->whereIn('id', $parentSecs)->get();
            foreach ($parentSecs as $parentSec) {
                $this->sectionSelecteds[$parentSec->id] = $parentSec->h1;
                $this->parentSec[$parentSec->id] = $parentSec->id;
            }
        }

        $parentBreads = json_decode($heading->parent_bread);
        if($parentBreads){
            $parentBreads = DB::table('headings')->select("id","name")->whereIn('id', $parentBreads)->get();
            foreach ($parentBreads as $parentBread) {
                $this->breadcrumbSelecteds[$parentBread->id] = $parentBread->name;
                $this->parentBread[$parentBread->id] = $parentBread->id;
            }
        }

        if($heading->fade == 'true'){
            $this->fadeMenu = true;
        }

        if($heading->link_razdel == 'true'){
            $this->linkAddSection = true;
        }

        if($heading->text){
            $this->firstText = $heading->text;
        }

        if($heading->firsttext){
            $this->lastText = $heading->firsttext;
        }

        if($heading->img){
            $this->rubImg = $heading->img;
        } else {
            $this->temporaryUrl = true;
        }

        $cooks = $heading->w_cook;
        if(!empty($cooks)){
            $cooks = explode(' | ', $cooks);
            foreach ($cooks as $cook){
                $cook = explode(' / ', $cook);
                $id = microtime();
                $this->cookSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$cook[0].'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$cook[1].'</span><i wire:click="methodRemoveItemId('.$id.')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            }
        }

        $incIngrs = json_decode($heading->ingredients_accept);
        if($incIngrs){
            $incIngrs = DB::table('ingredients')->select("id","name")->whereIn('id', $incIngrs)->get();
            foreach ($incIngrs as $incIngr) {
                $this->incIngrSelecteds[$incIngr->id] = $incIngr->name;
                $this->incIngr[$incIngr->id] = $incIngr->id;
            }
        }

        $excIngrs = json_decode($heading->ingredients_block);
        if($excIngrs){
            $excIngrs = DB::table('ingredients')->select("id","name")->whereIn('id', $excIngrs)->get();
            foreach ($excIngrs as $excIngr) {
                $this->excIngrSelecteds[$excIngr->id] = $excIngr->name;
                $this->excIngr[$excIngr->id] = $excIngr->id;
            }
        }

        $methods = json_decode($heading->cooking_m);
        if($methods){
            $methods = DB::table('ingredients')->select("id","name")->whereIn('id', $methods)->get();
            foreach ($methods as $method) {
                $this->methodSelecteds[$method->id] = $method->name;
                $this->method[$method->id] = $method->id;
            }
        }


    }


    public function render()
    {
        return view('livewire.headings.headings-edit-param');
    }
}
