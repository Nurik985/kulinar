<?php

namespace App\Livewire\Rubricator;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Rubricator extends Component
{
    use WithFileUploads;

    public $headerMenu = [];
    public $bannerMenu = [];
    public $sideBarBlock = [];

    public function mount()
    {
        $headerMenu = DB::table('categories')->get();
        foreach ($headerMenu as $menu){
            if($menu->name == 'headerMenu'){
                $header_menu = json_decode($menu->content, 1);
                foreach ($header_menu as $k => $_menu){
                    $this->headerMenu[$k]['icon'] = $_menu['icon'];
                    $this->headerMenu[$k]['name'] = $_menu['name'];
                    $this->headerMenu[$k]['url'] = $_menu['url'];
                }
            }

            if($menu->name == 'bannerMenu'){
                $banner_menu = json_decode($menu->content, 1);
                foreach ($banner_menu as $k => $_menu){
                    $this->bannerMenu[$k]['name'] = $_menu['name'];
                    if(!empty($_menu['selecteds'])){
                        foreach ($_menu['selecteds'] as $key => $selected) {
                            $this->bannerMenu[$k]['selecteds'][$key] = $selected;
                        }
                    }
                }
            }

            if($menu->name == 'sideBarMenu'){
                $side_bar_menu = json_decode($menu->content, 1);

                foreach ($side_bar_menu as $k => $_menu){
                    $this->sideBarBlock[$k]['block'] = $_menu['block']['name'];
                    if(!empty($_menu['block']['menu'])){
                        foreach ($_menu['block']['menu'] as $key => $blockMenu) {
                            $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['menu'] = $blockMenu['name'];
                            if(!empty($blockMenu['selecteds'])){
                                foreach ($blockMenu['selecteds'] as $selectedKey => $selected) {
                                    $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['selecteds'][$selectedKey] = $selected;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function addHeaderMenu(): void
    {
        $this->headerMenu[] = [];
    }

    public function addBannerMenu(): void
    {
        $this->bannerMenu[] = [];
    }

    public function addSideBarBlock(): void
    {
        $this->sideBarBlock[] = [];
    }

    public function addSideBarBlockMenu($k): void
    {
        $this->sideBarBlock[$k]['sideBarBlockMenu'][] = [];
    }

    public function removeIcon($k): void
    {
        $this->headerMenu[$k]['icon'] = '';
    }

    public function removeHeaderMenu($k): void
    {
        unset($this->headerMenu[$k]);
        $this->headerMenu = array_values($this->headerMenu);
    }

    public function removeBannerMenu($k): void
    {
        unset($this->bannerMenu[$k]);
        $this->bannerMenu = array_values($this->bannerMenu);
    }

    public function removeSideBarBlock($k): void
    {
        unset($this->sideBarBlock[$k]);
        $this->sideBarBlock = array_values($this->sideBarBlock);
    }

    public function removeSideBarBlockMenu($k, $menu): void
    {
        unset($this->sideBarBlock[$k]['sideBarBlockMenu'][$menu]);
        $this->sideBarBlock[$k]['sideBarBlockMenu'] = array_values($this->sideBarBlock[$k]['sideBarBlockMenu']);
    }

    public function searchBannerMenu($k): void
    {
        if($this->bannerMenu[$k]['searchText'] != '' && strlen($this->bannerMenu[$k]['searchText']) > 3){
            $searchText = $this->bannerMenu[$k]['searchText'];
            $results = '';
            $res = DB::table('headings')->select("id","name")->where('name','LIKE',"$searchText%")->orWhere('name','LIKE',"% $searchText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="bannerMenuLiClick('.$k.', '.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->bannerMenu[$k]['searchResult'] = $results;
        }
    }

    public function sideBarBlockMenuSearch($k, $key): void
    {
        if($this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['searchText'] != '' && strlen($this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['searchText']) > 3){
            $searchText = $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['searchText'];
            $results = '';
            $res = DB::table('headings')->select("id","name")->where('name','LIKE',"$searchText%")->orWhere('name','LIKE',"% $searchText%")->orderByRaw('CHAR_LENGTH(name) ASC')->limit(50)->get();
            if($res){
                foreach ($res as $r) {
                    $results .= '<li wire:click="sideBarBlockMenuClick('.$k.', '.$key.', '.$r->id.', \''.$r->name.'\')" class="py-1 px-2" id="' . $r->id . '">' . $r->name . '</li>';
                }
            }
            $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['searchResult'] = $results;
        }
    }

    public function bannerMenuLiClick($k, $id, $name)
    {
        if($k != '' && $id != '' && $name != ''){
            $this->bannerMenu[$k]['selecteds'][$id] = $name;
            $this->bannerMenu[$k]['searchResult'] = '';
            $this->bannerMenu[$k]['searchText'] = '';
        }
    }

    public function sideBarBlockMenuClick($k, $key, $id, $name)
    {
        if($k != '' && $key != '' && $id != '' && $name != ''){
            $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['selecteds'][$id] = $name;
            $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['searchResult'] = '';
            $this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['searchText'] = '';
        }
    }

    public function bannerMenuSelectedRemove($k, $id)
    {
        unset($this->bannerMenu[$k]['selecteds'][$id]);
    }

    public function sideBarBlockMenuSelectedRemove($k, $key, $id)
    {
        unset($this->sideBarBlock[$k]['sideBarBlockMenu'][$key]['selecteds'][$id]);
    }

    public function saveRubricator()
    {
        $headerMenu = [];
        if(!empty($this->headerMenu)){
            foreach ($this->headerMenu as $k => $menu) {
                if(!empty($menu['icon']) && !empty($menu['name']) && !empty($menu['url'])){
                    $headerMenu[$k]['icon'] = $menu['icon'];
                    $headerMenu[$k]['name'] = $menu['name'];
                    $headerMenu[$k]['url'] = $menu['url'];
                }
            }

            $headerMenu = json_encode($headerMenu, JSON_UNESCAPED_UNICODE);
            Category::updateOrCreate([
                'name'   => 'headerMenu',
            ],[
                'content'     => $headerMenu,
            ]);
        }

        $bannerMenu = [];
        if(!empty($this->bannerMenu)){
            foreach ($this->bannerMenu as $k => $menu) {
                if(!empty($menu['name'])){
                    $bannerMenu[$k]['name'] = $menu['name'];
                    if(!empty($menu['selecteds'])){
                        foreach ($menu['selecteds'] as $key => $selected) {
                            $bannerMenu[$k]['selecteds'][$key] = $selected;
                        }
                    }
                }
            }

            $bannerMenu = json_encode($bannerMenu, JSON_UNESCAPED_UNICODE);
            Category::updateOrCreate([
                'name'   => 'bannerMenu',
            ],[
                'content'     => $bannerMenu,
            ]);
        }

        $sideBarMenu = [];
        if(!empty($this->sideBarBlock)){
            foreach ($this->sideBarBlock as $k => $menu) {
                if(!empty($menu['block'])){
                    $sideBarMenu[$k]['block']['name'] = $menu['block'];
                    if(!empty($menu['sideBarBlockMenu'])){
                        foreach ($menu['sideBarBlockMenu'] as $keys => $sideBarBlockMenu) {
                            if(!empty($sideBarBlockMenu['menu'])){
                                $sideBarMenu[$k]['block']['menu'][$keys]['name'] = $sideBarBlockMenu['menu'];
                            }
                            if(!empty($sideBarBlockMenu['selecteds'])){
                                foreach ($sideBarBlockMenu['selecteds'] as $key => $selected) {
                                    $sideBarMenu[$k]['block']['menu'][$keys]['selecteds'][$key] = $selected;
                                }
                            }
                        }
                    }
                }
            }

            $sideBarMenu = json_encode($sideBarMenu, JSON_UNESCAPED_UNICODE);
            Category::updateOrCreate([
                'name'   => 'sideBarMenu',
            ],[
                'content'     => $sideBarMenu,
            ]);
        }

        session()->flash('success', "Данные рубрикатора успешно сохранены");
        $this->dispatch('hideAlert');

    }

    public function render()
    {
        return view('livewire.rubricator.rubricator');
    }
}
