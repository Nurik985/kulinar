<?php

namespace App\Livewire\Headings;

use App\Models\Heading;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeadingsCreateParam extends Component
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

    /********************************** COOK ******************************/

    public function cookSearchFunc(): void
    {
        if($this->cookSearchText != ''){
            $results = '';
            $res = DB::table('cooks')->select("id","name")->whereNotIn('id', $this->cookSearchRemoveIds)->where('name','LIKE',"%$this->cookSearchText%")->orderBy('name', 'ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="cookLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->cookSearchResults = $results;
        }
    }

    public function cookLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            //$this->cookSelecteds[$id] = $name;
            $dop = 'и';
            if($this->cookCheck){
                $dop = 'или';
            }
            $this->cookSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="cookRemoveItemId('.$id.')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->cookSearchRemoveIds[$id] = $id;
            $this->cookSearchResults = '';
            $this->cookSearchText = '';
            $this->cookShow = false;
            $this->cook[$id] = (count($this->cook) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function cookShowCheck(){
        $this->cookShow = true;
    }

    public function cookRemoveItemId($id): void
    {
        if($id){
            $this->cookSearchResults = '';
            unset($this->cookSelecteds[$id]);
            unset($this->cookSearchRemoveIds[$id]);
            unset($this->cook[$id]);
        }
    }

    /********************************** COOK END ******************************/

    /********************************** INC INGREDIENT ******************************/

    public function incIngrSearchFunc(): void
    {
        if($this->incIngrSearchText != ''){
            $results = '';
            $res = DB::table('ingredients')->select("id","name")->whereNotIn('id', $this->incIngrSearchRemoveIds)->where('name','LIKE',"$this->incIngrSearchText%")->orWhere('name','LIKE',"% $this->incIngrSearchText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="incIngrLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->incIngrSearchResults = $results;
        }
    }

    public function incIngrLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            //$this->incIngrSelecteds[$id] = $name;
            $dop = 'и';
            if($this->incIngrCheck){
                $dop = 'или';
            }
            $this->incIngrSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="incIngrRemoveItemId('.$id.')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->incIngrSearchRemoveIds[$id] = $id;
            $this->incIngrSearchResults = '';
            $this->incIngrSearchText = '';
            $this->incIngrShow = false;
            $this->incIngr[$id] = (count($this->incIngr) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function incIngrShowCheck(){
        $this->incIngrShow = true;
    }

    public function incIngrRemoveItemId($id): void
    {
        if($id){
            $this->incIngrSearchResults = '';
            unset($this->incIngrSelecteds[$id]);
            unset($this->incIngrSearchRemoveIds[$id]);
            unset($this->incIngr[$id]);
        }
    }

    /********************************** INC INGREDIENT END ******************************/

    /********************************** EXC INGREDIENT ******************************/

    public function excIngrSearchFunc(): void
    {
        if($this->excIngrSearchText != ''){
            $results = '';
            $res = DB::table('ingredients')->select("id","name")->whereNotIn('id', $this->excIngrSearchRemoveIds)->where('name','LIKE',"$this->excIngrSearchText%")->orWhere('name','LIKE',"% $this->excIngrSearchText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="excIngrLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->excIngrSearchResults = $results;
        }
    }

    public function excIngrLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            //$this->excIngrSelecteds[$id] = $name;
            $dop = 'и';
            if($this->excIngrCheck){
                $dop = 'или';
            }
            $this->excIngrSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="excIngrRemoveItemId('.$id.')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->excIngrSearchRemoveIds[$id] = $id;
            $this->excIngrSearchResults = '';
            $this->excIngrSearchText = '';
            $this->excIngrShow = false;
            $this->excIngr[$id] = (count($this->excIngr) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function excIngrShowCheck(){
        $this->excIngrShow = true;
    }

    public function excIngrRemoveItemId($id): void
    {
        if($id){
            $this->excIngrSearchResults = '';
            unset($this->excIngrSelecteds[$id]);
            unset($this->excIngrSearchRemoveIds[$id]);
            unset($this->excIngr[$id]);
        }
    }

    /********************************** EXC INGREDIENT END ******************************/

    /********************************** METHOD INGREDIENT ******************************/

    public function methodSearchFunc(): void
    {
        if($this->methodSearchText != ''){
            $results = '';
            $res = DB::table('methods')->select("id","name")->whereNotIn('id', $this->methodSearchRemoveIds)->where('name','LIKE',"%$this->methodSearchText%")->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="methodLiClick('.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->methodSearchResults = $results;
        }
    }

    public function methodLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            //$this->methodSelecteds[$id] = $name;
            $dop = 'и';
            if($this->methodCheck){
                $dop = 'или';
            }
            $this->methodSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="methodRemoveItemId('.$id.')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->methodSearchRemoveIds[$id] = $id;
            $this->methodSearchResults = '';
            $this->methodSearchText = '';
            $this->methodShow = false;
            $this->method[$id] = (count($this->method) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function methodShowCheck(){
        $this->methodShow = true;
    }

    public function methodRemoveItemId($id): void
    {
        if($id){
            $this->methodSearchResults = '';
            unset($this->methodSelecteds[$id]);
            unset($this->methodSearchRemoveIds[$id]);
            unset($this->method[$id]);
        }
    }

    /********************************** METHOD INGREDIENT END ******************************/

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
        return view('livewire.headings.headings-create-param');
    }
}
