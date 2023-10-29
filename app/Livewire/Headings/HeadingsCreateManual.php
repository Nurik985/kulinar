<?php

namespace App\Livewire\Headings;

use App\Models\Heading;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeadingsCreateManual extends Component
{
    use WithFileUploads;


    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $name;

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $title;

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Поле должен содержать мин 3 символа')]
    #[Rule('regex:/^[a-zA-Z-]+$/u', message: 'ЧПУ должен содержать только латиницу')]
    #[Rule('unique:' . Heading::class . ',url', message: 'Такой URL уже существует. Измените его')]
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

    public $recipSearchText = '';
    public $recipSearchResults = '';
    public $recipSelecteds = [];
    public $recipSearchRemoveIds = [];

    public function generateSlug()
    {
        $this->url = Str::slug($this->name);
        $this->validate();
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
            $res = DB::table('recipe')->select("id","name")->whereNotIn('id', $this->recipSearchRemoveIds)->where('name','LIKE',"%$this->recipSearchText%")->orderBy('name', 'ASC')->limit(50)->get();
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
            $this->parentBread[$id] = $id;
        }
    }

    public function recipRemoveItemId($id): void
    {
        if($id){
            $this->recipSearchResults = '';
            unset($this->recipSelecteds[$id]);
            unset($this->recipSearchRemoveIds[$id]);
            unset($this->parentBread[$id]);
        }
    }

    /********************************** RECIP END ******************************/



    public function delRubImg(): void
    {
        $this->rubImg = '';
    }

    public function saveHeading()
    {
        $this->validate();

        if ($this->fadeMenu == null) {
            $this->fadeMenu = 'false';
        } else {
            $this->fadeMenu = 'true';
        }


        if($this->rubImg){
            //$this->rubImg->store('rubrica');
            $this->storedImage = $this->rubImg->store('rubrica');
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

        Heading::create([
            'name' => $this->name,
            'url' => $this->url,
            'title' => $this->title,
            'text' => $this->firstText,
            'w_cook' => $cook,
            'ingredients_accept' => $incIngr,
            'ingredients_block' => $excIngr,
            'cooking_m' => $method,
            'type' => 1,
            'fade' => $this->fadeMenu,
            'link_razdel' => 'false',
            'parent' => json_encode($parentRub),
            'recept' => null,
            'col_recipe' => null,
            'parent_sect' => json_encode($parentSec),
            'col_public_recipe' => 77,
            'img' => $this->storedImage,
            'osn_section' => 1,
            'parent_bread' => json_encode($parentBread),
            'firsttext' => $this->lastText,
        ]);

        session()->flash('success', "Раздел успшено создан");

        return redirect()->to(route('rubrica.index'));
    }

    public function render()
    {
        return view('livewire.headings.headings-create-manual');
    }
}
