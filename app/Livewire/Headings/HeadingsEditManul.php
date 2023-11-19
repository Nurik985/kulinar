<?php

namespace App\Livewire\Headings;

use App\Models\Heading;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeadingsEditManul extends Component
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
    public $recieps = [];
    public $storedImage;

    public $rubImg;
    public $rubImgPatch;

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

    public $recipSearchText = '';
    public $recipSearchResults = '';
    public $recipSelecteds = [];
    public $recipSearchRemoveIds = [];

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

        $recepts = json_decode($heading->recept);
        if($recepts){
            $recepts = DB::table('recipes')->select("id","name")->whereIn('id', $recepts)->get();
            foreach ($recepts as $recept) {
                $this->recipSelecteds[$recept->id] = $recept->name;
                $this->recieps[$recept->id] = $recept->id;
            }
        }
    }

    public function generateSlug()
    {
        $this->url = Str::slug($this->name);
        $this->validate();
    }

    public function delRubImg(): void
    {
        $this->rubImg = '';
        $this->temporaryUrl = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /********************************** RUBRICS ******************************/

    public function rubricSearchFunc(): void
    {
        if($this->rubricSearchText != ''){
            $results = '';
            $res = DB::table('headings')->select("id","name")->whereNotIn('id', $this->rubricSearchRemoveIds)->where('name','LIKE',"%$this->rubricSearchText%")->orderBy('name', 'ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="rubricLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->rubricSearchResults = $results;
        }
    }

    public function rubricLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            $this->rubricSelecteds[$id] = $name;
            $this->rubricSearchRemoveIds[$id] = $id;
            $this->rubricSearchResults = '';
            $this->rubricSearchText = '';
            $this->parentRub[$id] = $id;
        }
    }

    public function rubricRemoveItemId($id): void
    {
        if($id){
            $this->rubricSearchResults = '';
            unset($this->rubricSelecteds[$id]);
            unset($this->rubricSearchRemoveIds[$id]);
            unset($this->parentRub[$id]);
        }
    }

    /********************************** RUBRICS END ******************************/

    /********************************** SECTIONS ******************************/

    public function sectionSearchFunc(): void
    {
        if($this->sectionSearchText != ''){
            $results = '';
            $res = DB::table('sections')->select("id","h1")->whereNotIn('id', $this->sectionSearchRemoveIds)->where('h1','LIKE',"%$this->sectionSearchText%")->orderBy('h1', 'ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="sectionLiClick('.$r->id.', \''.$r->h1.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->h1 . '</li>';
                }
            }
            $this->sectionSearchResults = $results;
        }
    }

    public function sectionLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            $this->sectionSelecteds[$id] = $name;
            $this->sectionSearchRemoveIds[$id] = $id;
            $this->sectionSearchResults = '';
            $this->sectionSearchText = '';
            $this->parentSec[$id] = $id;
        }
    }

    public function sectionRemoveItemId($id): void
    {
        if($id){
            $this->sectionSearchResults = '';
            unset($this->sectionSelecteds[$id]);
            unset($this->sectionSearchRemoveIds[$id]);
            unset($this->parentSec[$id]);
        }
    }

    /********************************** SECTIONS END ******************************/

    /********************************** BREADCRUMB ******************************/

    public function breadcrumbSearchFunc(): void
    {
        if($this->breadcrumbSearchText != ''){
            $results = '';
            $res = DB::table('headings')->select("id","name")->whereNotIn('id', $this->breadcrumbSearchRemoveIds)->where('name','LIKE',"%$this->breadcrumbSearchText%")->orderBy('name', 'ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="breadcrumbLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->breadcrumbSearchResults = $results;
        }
    }

    public function breadcrumbLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            $this->breadcrumbSelecteds[$id] = $name;
            $this->breadcrumbSearchRemoveIds[$id] = $id;
            $this->breadcrumbSearchResults = '';
            $this->breadcrumbSearchText = '';
            $this->parentBread[$id] = $id;
        }
    }

    public function breadcrumbRemoveItemId($id): void
    {
        if($id){
            $this->breadcrumbSearchResults = '';
            unset($this->breadcrumbSelecteds[$id]);
            unset($this->breadcrumbSearchRemoveIds[$id]);
            unset($this->parentBread[$id]);
        }
    }

    /********************************** BREADCRUMB END ******************************/

    /********************************** RECIPE ******************************/

    public function recipSearchFunc(): void
    {
        if($this->recipSearchText != ''){
            $results = '';
            $res = DB::table('recipes')->select("id","name")->whereNotIn('id', $this->recipSearchRemoveIds)->where('name','LIKE',"%$this->recipSearchText%")->orderBy('name', 'ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="recipLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->recipSearchResults = $results;
        }
    }

    public function recipLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            $this->recipSelecteds[$id] = $name;
            $this->recipSearchRemoveIds[$id] = $id;
            $this->recipSearchResults = '';
            $this->recipSearchText = '';
            $this->recieps[$id] = $id;
        }
    }

    public function recipRemoveItemId($id): void
    {
        if($id){
            $this->recipSearchResults = '';
            unset($this->recipSelecteds[$id]);
            unset($this->recipSearchRemoveIds[$id]);
            unset($this->recieps[$id]);
        }
    }

    /********************************** RECIP END ******************************/

    public function updateHeading()
    {
        $this->validate();

        if ($this->fadeMenu == null) {
            $this->fadeMenu = 'false';
        } else {
            $this->fadeMenu = 'true';
        }

        if ($this->linkAddSection == null) {
            $this->linkAddSection = 'false';
        } else {
            $this->linkAddSection = 'true';
        }

        if($this->temporaryUrl && $this->rubImg != ''){
            $this->storedImage = $this->rubImg->store('rubrics', 'public');
        } else {
            $this->storedImage = $this->rubImg;
        }

        if($this->cook){
            $cook = implode('', $this->cook);
        } else {
            $cook = null;
        }

        if($this->incIngr){
            $incIngr = implode('', $this->incIngr);
        } else {
            $incIngr = null;
        }

        if($this->excIngr){
            $excIngr = implode('', $this->excIngr);
        } else {
            $excIngr = null;
        }

        if($this->method){
            $method = implode('', $this->method);
        } else {
            $method = null;
        }

        $parentRub = [];
        if($this->parentRub){
            foreach ($this->parentRub as $p){
                $parentRub[] = $p;
            }
        }

        $parentSec = [];
        if($this->parentSec){
            foreach ($this->parentSec as $p){
                $parentSec[] = $p;
            }
        }

        $parentBread = [];
        if($this->parentBread){
            foreach ($this->parentBread as $p){
                $parentBread[] = $p;
            }
        }

        $recieps = [];
        if($this->recieps){
            foreach ($this->recieps as $p){
                $recieps[] = $p;
            }
        }

        $osn_section = array_first($this->parentSec);

        $heading = Heading::find($this->id);

        $heading->update([
            'name' => $this->name,
            'url' => $this->url,
            'title' => $this->title,
            'text' => $this->firstText,
            'w_cook' => $cook,
            'ingredients_accept' => $incIngr,
            'ingredients_block' => $excIngr,
            'cooking_m' => $method,
            'type' => 2,
            'fade' => $this->fadeMenu,
            'link_razdel' => $this->linkAddSection,
            'parent' => json_encode($parentRub, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'recept' => json_encode($recieps, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'col_recipe' => null,
            'parent_sect' => json_encode($parentSec, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'col_public_recipe' => null,
            'img' => $this->storedImage,
            'osn_section' => $osn_section,
            'parent_bread' => json_encode($parentBread, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'firsttext' => $this->lastText,
        ]);

        $heading->sections()->detach();
        $heading->sections()->attach($parentSec);
        forceRecipe($this->id);

        session()->flash('success', "Рубрика успшено изменен");

        return redirect()->to(route('rubrica.index'));
    }



    public function render()
    {
        return view('livewire.headings.headings-edit-manul');
    }
}
