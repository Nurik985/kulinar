<?php

namespace App\Livewire\Headings;


use App\Models\Method;
use App\Models\Cook;
use App\Models\Heading;
use App\Models\Ingredient;
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
    #[Rule('regex:/^[a-zA-Z1-9-]+$/u', message: 'ЧПУ должен содержать только латиницу')]
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
    public $cookSearchRemove = [];
    public $cookShow = false;
    public $cookCheck;
    public $cookSearchId = 1;

    public $incIngrSearchText = '';
    public $incIngrSearchResults = '';
    public $incIngrSelecteds = [];
    public $incIngrSearchRemove = [];
    public $incIngrShow = false;
    public $incIngrCheck;
    public $incIngrSearchId = 1;

    public $excIngrSearchText = '';
    public $excIngrSearchResults = '';
    public $excIngrSelecteds = [];
    public $excIngrSearchRemove = [];
    public $excIngrShow = false;
    public $excIngrCheck;
    public $excIngrSearchId = 1;

    public $methodSearchText = '';
    public $methodSearchResults = '';
    public $methodSelecteds = [];
    public $methodSearchRemove = [];
    public $methodShow = false;
    public $methodCheck;
    public $methodSearchId = 1;

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

        $this->sectionSearchResults = '';
        $this->breadcrumbSearchResults = '';
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

        $this->rubricSearchResults = '';
        $this->breadcrumbSearchResults = '';
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

        $this->rubricSearchResults = '';
        $this->sectionSearchResults = '';
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
            $res = DB::table('cooks')->select("id","name")->where('name','LIKE',"%$this->cookSearchText%")->orderBy('name', 'ASC')->limit(50)->get();
            if($res){
                $k = $this->cookSearchId;
                foreach ($res as $r) {
                    $class = '';
                    if(in_array($r->name, $this->cookSearchRemove)){
                        $class = 'hidden';
                    }
                    $results .= '<li wire:click="cookLiClick('.$k.', \''.$r->name.'\')" class="py-1 px-2 '.$class.'" id="' . $k . '">' . $r->name . '</li>';
                    $k++;
                }
                $this->cookSearchId = $k;
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
            $this->cookSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="cookRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->cookSearchRemove[] = $name;
            $this->cookSearchResults = '';
            $this->cookSearchText = '';
            $this->cookShow = false;
            $this->cook[$id] = (count($this->cook) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function cookAdd(){
        $name = $this->cookSearchText;
        $id = $this->cookSearchId + 1;
        $this->cookSearchId = $id + 1;

        $dop = 'и';
        if($this->cookCheck){
            $dop = 'или';
        }

        $this->cookSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="cookRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->cookSearchResults = '';
        $this->cookSearchText = '';
        $this->cookShow = false;
        $this->cook[$id] = (count($this->cook) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
    }

    public function cookShowCheck(){
        $this->cookShow = true;
        $this->incIngrShow = false;
        $this->excIngrShow = false;
        $this->methodShow = false;
    }

    public function cookRemoveItemId($id, $name): void
    {
        if($id){
            $key = array_search($name, $this->cookSearchRemove);
            $this->cookSearchResults = '';

            if (array_key_exists($id, $this->cookSelecteds)) {
                unset($this->cookSelecteds[$id]);
            }

            if($key !== false){
                unset($this->cookSearchRemove[$key]);
            }

            if (array_key_exists($id, $this->cook)) {
                unset($this->cook[$id]);
            }
        }
    }

    /********************************** COOK END ******************************/

    /********************************** INC INGREDIENT ******************************/

    public function incIngrSearchFunc(): void
    {
        if($this->incIngrSearchText != ''){
            $results = '';
            $res = DB::table('ingredients')->select("id","name")->where('name','LIKE',"$this->incIngrSearchText%")->orWhere('name','LIKE',"% $this->incIngrSearchText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();
            if($res){
                $k = $this->incIngrSearchId;
                foreach ($res as $r) {
                    $class = '';
                    if(in_array($r->name, $this->incIngrSearchRemove)){
                        $class = 'hidden';
                    }
                    $results .= '<li wire:click="incIngrLiClick('.$k.', \''.$r->name.'\')" class="py-1 px-2 '.$class.'" id="' . $k . '">' . $r->name . '</li>';
                    $k++;
                }
                $this->incIngrSearchId = $k;
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
            $this->incIngrSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="incIngrRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->incIngrSearchRemove[] = $name;
            $this->incIngrSearchResults = '';
            $this->incIngrSearchText = '';
            $this->incIngrShow = false;
            $this->incIngr[$id] = (count($this->incIngr) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function incIngrAdd(){
        $name = $this->incIngrSearchText;
        $id = $this->incIngrSearchId + 1;
        $this->incIngrSearchId = $id + 1;

        $dop = 'и';
        if($this->incIngrCheck){
            $dop = 'или';
        }

        $this->incIngrSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="incIngrRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->incIngrSearchResults = '';
        $this->incIngrSearchText = '';
        $this->incIngrShow = false;
        $this->incIngr[$id] = (count($this->incIngr) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
    }

    public function incIngrShowCheck(){
        $this->cookShow = false;
        $this->incIngrShow = true;
        $this->excIngrShow = false;
        $this->methodShow = false;
    }

    public function incIngrRemoveItemId($id, $name): void
    {
        if($id){
            $key = array_search($name, $this->incIngrSearchRemove);
            $this->incIngrSearchResults = '';

            if (array_key_exists($id, $this->incIngrSelecteds)) {
                unset($this->incIngrSelecteds[$id]);
            }

            if($key !== false){
                unset($this->incIngrSearchRemove[$key]);
            }

            if (array_key_exists($id, $this->incIngr)) {
                unset($this->incIngr[$id]);
            }
        }
    }

    /********************************** INC INGREDIENT END ******************************/

    /********************************** EXC INGREDIENT ******************************/

    public function excIngrSearchFunc(): void
    {
        if($this->excIngrSearchText != ''){
            $results = '';
            $res = DB::table('ingredients')->select("id","name")->where('name','LIKE',"$this->excIngrSearchText%")->orWhere('name','LIKE',"% $this->excIngrSearchText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();
            if($res){
                $k = $this->excIngrSearchId;
                foreach ($res as $r) {
                    $class = '';
                    if(in_array($r->name, $this->excIngrSearchRemove)){
                        $class = 'hidden';
                    }
                    $results .= '<li wire:click="excIngrLiClick('.$k.', \''.$r->name.'\')" class="py-1 px-2 '.$class.'" id="' . $k . '">' . $r->name . '</li>';
                    $k++;
                }
                $this->excIngrSearchId = $k;
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
            $this->excIngrSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="excIngrRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->excIngrSearchRemove[] = $name;
            $this->excIngrSearchResults = '';
            $this->excIngrSearchText = '';
            $this->excIngrShow = false;
            $this->excIngr[$id] = (count($this->excIngr) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function excIngrAdd(){
        $name = $this->excIngrSearchText;
        $id = $this->excIngrSearchId + 1;
        $this->excIngrSearchId = $id + 1;

        $dop = 'и';
        if($this->excIngrCheck){
            $dop = 'или';
        }

        $this->excIngrSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="excIngrRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->excIngrSearchResults = '';
        $this->excIngrSearchText = '';
        $this->excIngrShow = false;
        $this->excIngr[$id] = (count($this->excIngr) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
    }

    public function excIngrShowCheck(){
        $this->cookShow = false;
        $this->excIngrShow = true;
        $this->incIngrShow = false;
        $this->methodShow = false;
    }

    public function excIngrRemoveItemId($id, $name): void
    {
        if($id){
            $key = array_search($name, $this->excIngrSearchRemove);
            $this->excIngrSearchResults = '';

            if (array_key_exists($id, $this->excIngrSelecteds)) {
                unset($this->excIngrSelecteds[$id]);
            }

            if($key !== false){
                unset($this->excIngrSearchRemove[$key]);
            }

            if (array_key_exists($id, $this->excIngr)) {
                unset($this->excIngr[$id]);
            }
        }
    }

    /********************************** EXC INGREDIENT END ******************************/

    /********************************** METHOD INGREDIENT ******************************/

    public function methodSearchFunc(): void
    {
        if($this->methodSearchText != ''){
            $results = '';
            $res = DB::table('methods')->select("id","name")->where('name','LIKE',"%$this->methodSearchText%")->limit(50)->get();
            if($res){
                $k = $this->methodSearchId;
                foreach ($res as $r) {
                    $class = '';
                    if(in_array($r->name, $this->methodSearchRemove)){
                        $class = 'hidden';
                    }
                    $results .= '<li wire:click="methodLiClick('.$k.', \''.$r->name.'\')" class="py-1 px-2 '.$class.'" id="' . $k . '">' . $r->name . '</li>';
                    $k++;
                }
                $this->methodSearchId = $k;
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
            $this->methodSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="methodRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->methodSearchRemove[] = $name;
            $this->methodSearchResults = '';
            $this->methodSearchText = '';
            $this->methodShow = false;
            $this->method[$id] = (count($this->method) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
        }
    }

    public function methodAdd(){
        $name = $this->methodSearchText;
        $id = $this->methodSearchId + 1;
        $this->methodSearchId = $id + 1;

        $dop = 'и';
        if($this->methodCheck){
            $dop = 'или';
        }

        $this->methodSelecteds[$id] = '<div class="flex items-center"><div class="text-[16px] mr-2">'.$dop.'</div><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px] capitalize"><span id="'.$id.'" class="capitalize">'.$name.'</span><i wire:click="methodRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->methodSearchResults = '';
        $this->methodSearchText = '';
        $this->methodShow = false;
        $this->method[$id] = (count($this->method) > 0) ? ' | '.$dop .' / '.$name : $dop .' / '.$name  ;
    }

    public function methodShowCheck(){
        $this->cookShow = false;
        $this->incIngrShow = false;
        $this->excIngrShow = false;
        $this->methodShow = true;
    }

    public function methodRemoveItemId($id, $name): void
    {
        if($id){
            $key = array_search($name, $this->methodSearchRemove);
            $this->methodSearchResults = '';

            if (array_key_exists($id, $this->methodSelecteds)) {
                unset($this->methodSelecteds[$id]);
            }

            if($key !== false){
                unset($this->methodSearchRemove[$key]);
            }

            if (array_key_exists($id, $this->method)) {
                unset($this->method[$id]);
            }

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

        if ($this->linkAddSection == null) {
            $this->linkAddSection = 'false';
        } else {
            $this->linkAddSection = 'true';
        }


        if($this->rubImg){
            //$this->rubImg->store('rubrica');
            //$this->storedImage = $this->rubImg->store('public/rubrica');
            $this->storedImage = $this->rubImg->store('rubrics', 'public');
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

        $osn_section = array_first($this->parentSec);

        /*********************************************************/


        $genZapros = genZapros($incIngr, $excIngr, $cook, $method);

        $genzapros = '';
        if (!empty($genZapros)) {
            $genzapros = $genZapros;
        }
        /*********************************************************/

        $newHeading = Heading::create([
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
            'link_razdel' => $this->linkAddSection,
            'parent' => json_encode($parentRub, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'recept' => null,
            'col_recipe' => null,
            'parent_sect' => json_encode($parentSec, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'col_public_recipe' => null,
            'img' => $this->storedImage,
            'osn_section' => $osn_section,
            'parent_bread' => json_encode($parentBread, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK),
            'firsttext' => $this->lastText,
            'genzapros' => $genzapros,
        ]);

        $heading = Heading::find($newHeading->id);
        $heading->Sections()->detach();
        $heading->sections()->attach($parentSec);
        forceRecipe($newHeading->id);

        session()->flash('success', "Рубрика '<strong>".$heading->name."</strong>' успшено создан");

        return redirect()->to(route('rubrica.index'));
    }

    public function render()
    {
        return view('livewire.headings.headings-create-param');
    }
}
