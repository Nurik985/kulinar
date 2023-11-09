<?php

namespace App\Livewire\Recipes;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditRecipes extends Component
{
    use WithFileUploads;

    public $id;

    protected function rules()
    {
        return [
            'url' => 'required|min:3|regex:/^[a-zA-Z1-9-]+$/u|unique:' . Recipe::class . ',url,' . $this->id,
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

    public $linkSource;
    public $beforeText;
    public $recipeImg;
    public $ingLists = [];
    public $addIngRowInput;
    public $units;
    public $unitsShow = false;
    public $addAutoIngData;
    public $addAutoIngRow;
    public $autoIngDataFilled = false;
    public $addAutoIngRowRes;

    public $vremyGotovki;
    public $vremyGotovkiTime = 'мин';
    public $vremyPrigotovleniya;
    public $vremyPrigotovleniyaTime = 'мин';
    public $portion;
    public $portionType = 'порц.';
    public $portionTypeData;

    public $stepLists = [];
    public $addStepRowInput;
    public $addAutoStepData;

    public $afterText;

    public $cook = [];
    public $cookSearchText = '';
    public $cookSearchResults = '';
    public $cookSelecteds = [];
    public $cookSearchRemove = [];
    public $cookShow = false;
    public $cookCheck;
    public $cookSearchId = 1;

    public $method = [];
    public $methodSearchText = '';
    public $methodSearchResults = '';
    public $methodSelecteds = [];
    public $methodSearchRemove = [];
    public $methodShow = false;
    public $methodCheck;
    public $methodSearchId = 1;

    public $kitchen = [];
    public $kitchenSearchText = '';
    public $kitchenSearchResults = '';
    public $kitchenSelecteds = [];
    public $kitchenSearchRemove = [];
    public $kitchenShow = false;
    public $kitchenCheck;
    public $kitchenSearchId = 1;

    public $storedImage;

    public $status = 2;

    public $temporaryUrl = false;

    public function mount($recipeId)
    {
        $this->id = $recipeId;
        $recipe = DB::table('recipes')->where('id', '=', $recipeId)->first();

        $this->name = $recipe->name;
        $this->title = $recipe->title;
        $this->url = $recipe->url;

        if(!empty($recipe->link_source)){
            $this->linkSource = $recipe->link_source;
        }

        if(!empty($recipe->text)){
            $this->beforeText = $recipe->text;
        }

        if(!empty($recipe->autoingr)){
            $this->addAutoIngData = $recipe->autoingr;
        }

        if(!empty($recipe->zapingr)){
            $this->ingLists = json_decode($recipe->zapingr, 1);
        }

        if(!empty($recipe->cooking_t)){
            $cooking_t = json_decode($recipe->cooking_t, 1);

            if(!empty($cooking_t['time'])){
                $this->vremyPrigotovleniya = $cooking_t['time'];
            }

            if(!empty($cooking_t['units'])){
                $this->vremyPrigotovleniyaTime = $cooking_t['units'];
            }
        }

        if(!empty($recipe->cooking_tg)){
            $cooking_tg = json_decode($recipe->cooking_tg, 1);

            if(!empty($cooking_tg['time'])){
                $this->vremyGotovki = $cooking_tg['time'];
            }

            if(!empty($cooking_tg['units'])){
                $this->vremyGotovkiTime = $cooking_tg['units'];
            }

            if(!empty($cooking_tg['portion_type'])){
                $this->portionType = $cooking_tg['portion_type'];
            }
        }

        if(!empty($recipe->portion)){
            $this->portion = $recipe->portion;
        }


        if(!empty($recipe->steps)){
            $steps = json_decode($recipe->steps, 1);
            foreach ($steps as $key => $step) {
                if(!empty($step['text'])) {
                    $this->stepLists[$key]['text'] = $step['text'];
                }
                if(!empty($step['imgs'])){
                    foreach ($step['imgs'] as $k => $img) {
                        $this->stepLists[$key]['img'][$k] = $img;
                    }
                }
            }
        }

        if(!empty($recipe->end_text)){
            $this->afterText = $recipe->end_text;
        }

        if($recipe->img){
            $this->recipeImg = $recipe->img;
        } else {
            $this->temporaryUrl = true;
        }

        if(!empty($recipe->w_cook)){
            $cooks = json_decode($recipe->w_cook, 1);
            $k = $this->cookSearchId;
            foreach ($cooks as $cook){
                $this->cookSelecteds[$k] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$k.'">'.$cook.'</span><i wire:click="cookRemoveItemId('.$k.', \''.$cook.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
                $this->cook[$k] = $cook;
                $k++;
            }
            $this->cookSearchId = $k;
        }

        if(!empty($recipe->method)){
            $methods = json_decode($recipe->method, 1);
            $k = $this->methodSearchId;
            foreach ($methods as $method){
                $this->methodSelecteds[$k] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$k.'">'.$method.'</span><i wire:click="methodRemoveItemId('.$k.', \''.$method.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
                $this->method[$k] = $method;
                $k++;
            }
            $this->methodSearchId = $k;
        }

        if(!empty($recipe->world)){
            $kitchens = json_decode($recipe->world, 1);
            $k = $this->kitchenSearchId;
            foreach ($kitchens as $kitchen){
                $this->kitchenSelecteds[$k] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$k.'">'.$kitchen.'</span><i wire:click="kitchenRemoveItemId('.$k.', \''.$kitchen.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
                $this->kitchen[$k] = $kitchen;
                $k++;
            }

            $this->kitchenSearchId = $k;
        }

        if(!empty($recipe->status)) {
            $this->status = $recipe->status;
        }

        $this->addAutoIngRowRes = '<div class="block mb-2 text-sm font-light text-gray-500">Автозаполнение ингредиетов:</div>';
        $this->units = DB::table('units')->select('id', 'name')->get();
        $this->portionTypeData = DB::table('portions')->select( 'name')->orderBy('sort', 'ASC')->get();
    }

    public function generateSlug()
    {
        $this->url = Str::slug($this->name);
        $this->validate();
    }

    public function updateSort($ingLists): void
    {
        $newLists = [];
        foreach ($ingLists as $k => $ingList) {
            $newLists[$k] = $this->ingLists[$ingList['value']];
        }
        $this->ingLists = $newLists;
    }

    public function updateStep($stepLists): void
    {
        //dd($stepLists);
        $newLists = [];
        foreach ($stepLists as $k => $stepList) {
            $newLists[$k] = $this->stepLists[$stepList['value']];
        }
        $this->stepLists = $newLists;
    }

    public function removeIngList($listId): void
    {
        unset($this->ingLists[$listId]);
        $this->ingLists = array_values($this->ingLists);
    }

    public function removeStepList($listId): void
    {
        unset($this->stepLists[$listId]);
        $this->stepLists = array_values($this->stepLists);
    }

    public function removeStepListImg($listId, $key)
    {
        unset($this->stepLists[$listId]['img'][$key]);
        $this->stepLists[$listId]['img'] = array_values($this->stepLists[$listId]['img']);
    }

    public function addIngRowInputBtn(): void
    {
        if($this->addIngRowInput){
            for($i = 0; $i < $this->addIngRowInput; $i++){
                $this->ingLists[] = [];
            }
        } else {
            $this->ingLists[] = [];
        }
        $this->addIngRowInput = '';
    }

    public function addStepRowInputBtn(): void
    {
        if($this->addStepRowInput){
            for($i = 0; $i < $this->addStepRowInput; $i++){
                $this->stepLists[] = [];
            }
        } else {
            $this->stepLists[] = [];
        }
        $this->addStepRowInput = '';
    }

    public function ingListsAddEd($listId, $name): void
    {
        $this->ingLists[$listId]['inglists'][3]['bd'] = "yes";
        $this->ingLists[$listId]['inglists'][3]['name'] = $name;
        unset($this->ingLists[$listId]['unitsShow']);
    }

    public function getUnits($listId, $event): void
    {
        if($event == 'open'){
            $this->clearIngList($listId, 'unitsShow');
            $this->ingLists[$listId]['unitsShow'] = true;
        } else {
            unset($this->ingLists[$listId]['unitsShow']);
        }
    }

    public function clearIngList($listId, $el): void
    {
        if($this->ingLists){
            foreach ($this->ingLists as $k => $ingList) {
                if($k != $listId){
                    unset($this->ingLists[$k][$el]);
                }
            }
        }
    }

    public function addAutoIngBtns()
    {
        dd($this->addAutoIngData);
    }

    public function ingSearch($listId)
    {
        if($this->ingLists[$listId]['ingSearchText']){
            $strLength= str($this->ingLists[$listId]['ingSearchText'])->length();
            if($strLength >= 3){
                $sText = $this->ingLists[$listId]['ingSearchText'];
                $searchResult = '';

                $query = DB::table('ingredients')->select("id","name")->where('name','LIKE',"$sText%")->orWhere('name','LIKE',"% $sText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();

                if($query) {
                    if(!empty($this->ingLists[$listId]['ingSearchId'])){
                        $k = $this->ingLists[$listId]['ingSearchId'];
                    } else {
                        $k = 0;
                    }

                    foreach ($query as $q) {
                        $class = 'show';

                        if(!empty($this->ingLists[$listId]['ingSearchRemove'])){
                            if(in_array(ucfirst($q->name), $this->ingLists[$listId]['ingSearchRemove'])){
                                $class = 'hidden';
                            }
                        }

                        $this->ingLists[$listId]['ingSearchResults'][$k]['id'] = $q->id;
                        $this->ingLists[$listId]['ingSearchResults'][$k]['name'] = $q->name;
                        $this->ingLists[$listId]['ingSearchResults'][$k]['class'] = $class;
                        $k++;
                    }

                    $this->ingLists[$listId]['ingSearchId'] = $k;
                }
            } else {
                $this->ingLists[$listId]['ingSearchResults'] = [];
            }
        }
    }

    public function ingSearchClose($listId): void
    {
        unset($this->ingLists[$listId]['ingSearchText']);
        unset($this->ingLists[$listId]['ingSearchResults']);
    }

    public function ingSelect($listId, $selectId, $id, $name): void
    {
        $this->ingLists[$listId]['inglists'][0][$selectId] = $name;

        $this->ingLists[$listId]['selected'][$selectId]['id'] = $id;
        $this->ingLists[$listId]['selected'][$selectId]['name'] = $name;
        $this->ingLists[$listId]['selected'][$selectId]['bd'] = true;
        $this->ingLists[$listId]['ingSearchRemove'][] = $name;
        unset($this->ingLists[$listId]['ingSearchText']);
        unset($this->ingLists[$listId]['ingSearchResults']);

    }

    public function ingRemove($listId, $removeId, $name): void
    {
        $key = array_search($name, $this->ingLists[$listId]['ingSearchRemove']);
        unset($this->ingLists[$listId]['selected'][$removeId]);
        $this->ingLists[$listId]['selected'] = array_values($this->ingLists[$listId]['selected']);

        if($key !== false){
            unset($this->ingLists[$listId]['ingSearchRemove'][$key]);
            $this->ingLists[$listId]['ingSearchRemove'] = array_values($this->ingLists[$listId]['ingSearchRemove']);
        }
        unset($this->ingLists[$listId]['ingSearchText']);
        unset($this->ingLists[$listId]['ingSearchResults']);
        unset($this->ingLists[$listId]['inglists'][0][$removeId]);
    }

    public function clearAutoIngBtn()
    {
        $this->addAutoIngRowRes = '<div class="block mb-2 text-sm font-light text-gray-500">Автозаполнение ингредиетов:</div>';
        $this->addAutoIngData = '';
        $this->addAutoIngRow = '';
        $this->autoIngDataFilled = false;
    }


    public function addAutoIngBtn(): void
    {
        $this->addAutoIngRowRes = '<div class="block mb-2 text-sm font-light text-gray-500">Автозаполнение ингредиетов:</div>';
        $this->addAutoIngRow = '';
        $this->ingLists = [];
        $this->autoIngDataFilled = false;

        if(trim($this->addAutoIngData)){

            $key = 0;

            $this->autoIngDataFilled = true;
            $autoIngLists = explode(PHP_EOL, trim($this->addAutoIngData));

            $newLists = [];

            foreach ($autoIngLists as $k => $autoIngList) {

                preg_match('/(.*) -/', $autoIngList, $name);
                if ($name != null) {
                    $name = explode("$", $name[1]);

                    foreach ($name as $n) {
                        if (!empty($n)) {
                            $newLists[$key]['name'][] = trim($n);
                        }
                    }
                }



                if(!empty($newLists[$key]['name'])){
                    preg_match('/#(.*)#/', $autoIngList, $cols);
                    if ($cols != null) {
                        $col = explode('-', $cols[1]);
                        if(!empty($col[0])){
                            $newLists[$key]['ot'] = trim($col[0]);
                        }
                        if(!empty($col[1])){
                            $newLists[$key]['do'] = trim($col[1]);
                        }
                    }

                    preg_match('/&(.*)&/', $autoIngList, $units);
                    if ($units != null) {
                        $newLists[$key]['ed'] = trim($units[1]);
                    } else {
                        $newLists[$key]['ed'] = "";
                    }

                }

                $key = count($this->ingLists) + count($newLists);

            }

            if(count($newLists) != count($autoIngLists)){
                $class = 'text-red-500';
            } else {
                $class = 'text-green-500';
            }

            $this->addAutoIngRowRes = '<div class="block mb-2 text-sm font-bold '.$class.'">Результат заполнения - '.count($newLists).'/'.count($autoIngLists).'</div>';

            $rn = 0;
            foreach ($newLists as $k => $newList) {
                foreach ($newList['name'] as $nameKey => $item) {
                    $query = Ingredient::where('name', '=', $item)->firstOr(function (){});
                    if($query !== null) {
                        $this->ingLists[$k]['selected'][$nameKey]['bd'] = true;
                    } else {
                        $this->ingLists[$k]['selected'][$nameKey]['bd'] = false;
                    }
                    $this->ingLists[$k]['inglists'][0][$nameKey] = Str::ucfirst($item);
                    $this->ingLists[$k]['selected'][$nameKey]['id'] = $k;
                    $this->ingLists[$k]['selected'][$nameKey]['name'] = Str::ucfirst($item);
                    $this->ingLists[$k]['ingSearchRemove'][$nameKey] = Str::ucfirst($item);
                }

                if(!empty($newList['ot'])){
                    $this->ingLists[$k]['inglists'][1] = $newList['ot'];
                }
                if(!empty($newList['do'])){
                    $this->ingLists[$k]['inglists'][2] = $newList['do'];
                }
                if(!empty($newList['ed'])){
                    $query = Unit::where('name', '=', $newList['ed'])->firstOr(function (){});
                    if($query != null) {
                        $this->ingLists[$k]['inglists'][3]['bd'] = 'yes';
                    } else {
                        $this->ingLists[$k]['inglists'][3]['bd'] = 'no';
                    }
                    $this->ingLists[$k]['inglists'][3]['name'] = $newList['ed'];
                }

                $this->ingLists[$k]['ingSearchId'] = $key;
                $key++;
                $rn++;
            }
        } else {
            $this->addAutoIngRowRes = '<div class="block mb-2 text-sm font-light text-gray-500">Автозаполнение ингредиетов:</div>';
            $this->addAutoIngData = '';
            $this->addAutoIngRow = '';
            $this->autoIngDataFilled = false;
        }

    }

    public function addAutoStepBtn()
    {

        if(trim($this->addAutoStepData)){
            $autoIngLists = explode("$", $this->addAutoStepData);

            if(!empty($this->stepLists)){
                $key = count($this->stepLists);
            } else {
                $key = 0;
            }

            foreach ($autoIngLists as $autoIngList) {
                if(!empty(trim($autoIngList))){
                    $this->stepLists[$key]['desc'] = trim($autoIngList);
                    $key++;
                }
            }
        }
    }

    public function delRecipeImg(): void
    {
        $this->recipeImg = '';
    }

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

            $this->cookSelecteds[$id] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="cookRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->cookSearchRemove[] = $name;
            $this->cookSearchResults = '';
            $this->cookSearchText = '';
            $this->cookShow = false;
            $this->cook[$id] = $name;
        }
    }

    public function cookAdd(){
        $name = $this->cookSearchText;
        $id = $this->cookSearchId + 1;
        $this->cookSearchId = $id + 1;

        $this->cookSelecteds[$id] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="cookRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->cookSearchResults = '';
        $this->cookSearchText = '';
        $this->cookShow = false;
        $this->cook[$id] = $name;
    }

    public function cookShowCheck(): void
    {
        $this->cookShow = true;
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
            $this->methodSelecteds[$id] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="methodRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->methodSearchRemove[] = $name;
            $this->methodSearchResults = '';
            $this->methodSearchText = '';
            $this->methodShow = false;
            $this->method[$id] = $name;
        }
    }

    public function methodAdd(){
        $name = $this->methodSearchText;
        $id = $this->methodSearchId + 1;
        $this->methodSearchId = $id + 1;

        $this->methodSelecteds[$id] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px] capitalize"><span id="'.$id.'" class="capitalize">'.$name.'</span><i wire:click="methodRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->methodSearchResults = '';
        $this->methodSearchText = '';
        $this->methodShow = false;
        $this->method[$id] = $name;
    }

    public function methodShowCheck(){
        $this->cookShow = false;
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

    /********************************** KITCHEN INGREDIENT ******************************/

    public function kitchenSearchFunc(): void
    {
        if($this->kitchenSearchText != ''){
            $results = '';
            $res = DB::table('kitchens')->select("id","name")->where('name','LIKE',"%$this->kitchenSearchText%")->limit(50)->get();
            if($res){
                $k = $this->kitchenSearchId;
                foreach ($res as $r) {
                    $class = '';
                    if(in_array($r->name, $this->kitchenSearchRemove)){
                        $class = 'hidden';
                    }
                    $results .= '<li wire:click="kitchenLiClick('.$k.', \''.$r->name.'\')" class="py-1 px-2 '.$class.'" id="' . $k . '">' . $r->name . '</li>';
                    $k++;
                }
                $this->kitchenSearchId = $k;
            }
            $this->kitchenSearchResults = $results;
        }
    }

    public function kitchenLiClick($id, $name): void
    {
        if($id != '' && $name != ''){
            $this->kitchenSelecteds[$id] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="'.$id.'">'.$name.'</span><i wire:click="kitchenRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
            $this->kitchenSearchRemove[] = $name;
            $this->kitchenSearchResults = '';
            $this->kitchenSearchText = '';
            $this->kitchenShow = false;
            $this->kitchen[$id] = $name;
        }
    }

    public function kitchenAdd(){
        $name = $this->kitchenSearchText;
        $id = $this->kitchenSearchId + 1;
        $this->kitchenSearchId = $id + 1;

        $this->kitchenSelecteds[$id] = '<div class="flex items-center"><div class="block-item w-fit bg-gray-300 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px] capitalize"><span id="'.$id.'" class="capitalize">'.$name.'</span><i wire:click="kitchenRemoveItemId('.$id.', \''.$name.'\')" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div></div>';
        $this->kitchenSearchResults = '';
        $this->kitchenSearchText = '';
        $this->kitchenShow = false;
        $this->kitchen[$id] = $name;
    }

    public function kitchenShowCheck(){
        $this->cookShow = false;
        $this->kitchenShow = true;
    }

    public function kitchenRemoveItemId($id, $name): void
    {
        if($id){
            $key = array_search($name, $this->kitchenSearchRemove);
            $this->kitchenSearchResults = '';

            if (array_key_exists($id, $this->kitchenSelecteds)) {
                unset($this->kitchenSelecteds[$id]);
            }

            if($key !== false){
                unset($this->kitchenSearchRemove[$key]);
            }

            if (array_key_exists($id, $this->kitchen)) {
                unset($this->kitchen[$id]);
            }

        }
    }

    /********************************** KITCHEN INGREDIENT END ******************************/

    public function statusChange($i)
    {
        $this->status = $i;
    }


    public function updateRecipe()
    {
        $this->validate();

        $total_steps = 0;

        $kkal = 0;
        $prot = 0;
        $zhir = 0;
        $ugl = 0;

        if(!empty($this->recipeImg)){
            $this->storedImage = $this->recipeImg->store('recipe', 'public');
        }

        $god = date("Y");
        $mes= date("m");

        $steps = [];
        if(!empty($this->stepLists)){
            $total_steps = count($this->stepLists);
            foreach ($this->stepLists as $k => $stepList) {
                if(!empty($stepList['desc'])){
                    $steps[$k]['text'] = $stepList['desc'];
                }
                if(!empty($stepList['img'])){
                    foreach ($stepList['img'] as $key => $img){
                        $link = $stepList['img'][$key]->store('recipe/'.$god.'/'.$mes, 'public');
                        $steps[$k]['imgs'][$key] = $link;
                    }
                }
            }
        }

        $ingridients = [];
        if(!empty($this->ingLists)){
            foreach ($this->ingLists as $k => $ingList) {
                if(!empty($ingList['inglists'][0])){
                    $ingridients[$k][0] = '';
                    foreach ($ingList['inglists'][0] as $item) {

                        $ingridients[$k][0] .= $item;
                        if(end($ingList['inglists'][0]) != $item){
                            $ingridients[$k][0] .= '|';
                        }
                    }
                }
                if(!empty($ingList['inglists'][1])){
                    $ingridients[$k][1] = $ingList['inglists'][1];
                } else {
                    $ingridients[$k][1] = '';
                }
                if(!empty($ingList['inglists'][2])){
                    $ingridients[$k][2] = $ingList['inglists'][1];
                } else {
                    $ingridients[$k][2] = '';
                }
                if(!empty($ingList['inglists'][3]['name'])){
                    $ingridients[$k][3] = $ingList['inglists'][3]['name'];
                } else {
                    $ingridients[$k][3] = '';
                }
                if(!empty($ingList['inglists'][4])){
                    $ingridients[$k][4] = $ingList['inglists'][4];
                } else {
                    $ingridients[$k][4] = '';
                }
            }
        }

        $cooking_t = [];
        if(!empty($this->vremyPrigotovleniya)){
            $cooking_t['time'] = $this->vremyPrigotovleniya;
        }
        if(!empty($this->vremyPrigotovleniyaTime)){
            $cooking_t['units'] = $this->vremyPrigotovleniyaTime;
        }


        $cooking_tg = [];
        if(!empty($this->vremyGotovki)){
            $cooking_tg['time'] = $this->vremyGotovki;
        }
        if(!empty($this->vremyGotovkiTime)){
            $cooking_tg['units'] = $this->vremyGotovkiTime;
        }
        if(!empty($this->portionType)){
            $cooking_tg['portion_type'] = $this->portionType;
        }


        $calories['kkal'] = 0;
        $calories['protein'] = 0;
        $calories['zhir'] = 0;
        $calories['ugl'] = 0;

        $w_cook = [];
        if($this->cook){
            $w_cook = $this->cook;
            $w_cook = array_values($w_cook);
        }


        $method = [];
        if($this->method){
            $method = $this->method;
            $method = array_values($method);
        }


        $world = [];
        if($this->kitchen){
            $world = $this->kitchen;
            $world = array_values($world);
        }


        if(!empty($ingridients)) {

            $all_kkal = [];
            $all_protein = [];
            $all_fat = [];
            $all_carbohydrates = [];
            $kkal_dop = 0;
            $protein_dop = 0;
            $fat_dop = 0;
            $carbohydrates_dop = 0;

            if (!empty($method)) {
                //$method = json_decode($method, true);
                $methodRand = $method[array_rand($method)];
            }

            if (!empty($w_cook)) {
                //$w_cook = json_decode($w_cook, true);
                $w_cookRand = $w_cook[array_rand($w_cook)];
            }

            $res = DB::table('ingredients');
            $res->where(function ($query) use ($ingridients){
                foreach ($ingridients as $key => $value) {
                    $ing = explode('|', $value[0]);
                    $ing = $ing[array_rand($ing)];
                    if ($key == 0) {
                        $query->where('name', '=', $ing);
                    } else {
                        $query->orWhere('name', '=', $ing);
                    }
                }
            });
            $res = $res->get();
            foreach ($res as $r){
                if($r->kkal > 0){
                    $all_kkal[] = $r->kkal;
                }

                if($r->protein > 0){
                    $all_protein[] = $r->protein;
                }

                if($r->fat > 0){
                    $all_fat[] = $r->fat;
                }

                if($r->carbohydrates > 0){
                    $all_carbohydrates[] = $r->carbohydrates;
                }
            }

            if (!empty($methodRand)) {
                $methodRandCoef = DB::table('methods')->select('coef')->where('name', '=', $methodRand)->first();
                $methodRandCoef = $methodRandCoef->coef;
            } else {
                $methodRandCoef = 1;
            }

            if (!empty($w_cookRand)) {
                $w_cookRandCoef = DB::table('cooks')->select('coef')->where('name', '=', $w_cookRand)->first();
                $w_cookRandCoef = $w_cookRandCoef->coef;
                $coef = $methodRandCoef * $w_cookRandCoef;
            }

            if (count($all_kkal) > 0) {
                foreach ($all_kkal as $key => $value) {
                    $kkal_dop = $kkal_dop + $value;
                };
                $kkal_dop = $kkal_dop / count($all_kkal);
            }

            if (count($all_protein) > 0) {
                foreach ($all_protein as $key => $value) {
                    $protein_dop = $protein_dop + $value;
                };
                $protein_dop = $protein_dop / count($all_protein);
            }

            if (count($all_fat) > 0) {
                foreach ($all_fat as $key => $value) {
                    $fat_dop = $fat_dop + $value;
                };
                $fat_dop = $fat_dop / count($all_fat);
            }

            if (count($all_carbohydrates) > 0) {
                foreach ($all_carbohydrates as $key => $value) {
                    $carbohydrates_dop = $carbohydrates_dop + $value;
                };
                $carbohydrates_dop = $carbohydrates_dop / count($all_carbohydrates);
            }

            if (!is_numeric($kkal)) {
                $kkal = $kkal_dop * $coef;
            }
            if (!is_numeric($prot)) {
                $prot = $protein_dop * $coef;
            }
            if (!is_numeric($zhir)) {
                $zhir = $fat_dop * $coef;
            }
            if (!is_numeric($ugl)) {
                $ugl = $carbohydrates_dop * $coef;
            }

            $calories = ['kkal' => round($kkal, 1), 'protein' => round($prot, 1), 'zhir' => round($zhir, 1), 'ugl' => round($ugl, 1)];
        }

        $cooking_tg = json_encode($cooking_tg, JSON_UNESCAPED_UNICODE);
        $cooking_t = json_encode($cooking_t, JSON_UNESCAPED_UNICODE);
        $w_cook = json_encode($w_cook, JSON_UNESCAPED_UNICODE);
        $method = json_encode($method, JSON_UNESCAPED_UNICODE);
        $world = json_encode($world, JSON_UNESCAPED_UNICODE);
        $calories = json_encode($calories);
        $ingridients = json_encode($ingridients, JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
        $steps = json_encode($steps, JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);


        $updateRecipe = Recipe::find($this->id);

        $updateRecipe->update([
            'name' => $this->name,
            'url' => $this->url,
            'link_source' => $this->linkSource,
            'title' => $this->title,
            'text' => $this->beforeText,
            'ingridients' => $ingridients,
            'cooking_t' => $cooking_t,
            'cooking_tg' => $cooking_tg,
            'portion' => $this->portion,
            'calories' => $calories,
            'steps' => $steps,
            'end_text' => $this->afterText,
            'img' => $this->storedImage,
            'w_cook' => $w_cook,
            'method' => $method,
            'world' => $world,
            'status' => $this->status,
            'kkal' => $kkal,
            'protein' => $prot,
            'zhir' => $zhir,
            'ugl' => $ugl,
            'total_steps' => $total_steps,
            'autoingr' => $this->addAutoIngData,
        ]);

        if($this->status == 1){
            forceRecipeAll($this->id);
        }
        session()->flash('success', "Рецепт успшено изменен");

        return redirect()->to(route('recipe.index'));
    }
    public function render()
    {
        return view('livewire.recipes.edit-recipes');
    }
}
