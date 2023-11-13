<?php

namespace App\Livewire\Spiski\Ingredients;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Ingredients extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'name';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    #[Url()]
    public $perPage = 10;

    public $selectedItem = 0;
    public $modText;
    public $ing;

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

//    public function mount()
//    {
//
////        $notices = DB::table('recipes')
////            ->join('ingredients','recipes.ingridients' , 'LIKE', DB::RAW('CONCAT("%",ingredients.name,"%")'))
////            ->where('ingredients.name', 'LIKE', 'recipes.ingridients')
////            ->count();
////
////        dump($notices);
//
////        $ingridients = DB::table('ingredients')->select('id', 'name')->get();
////
////        foreach ($ingridients as $k => $ingridient) {
////            $this->ing[$ingridient->id]['name'] = $ingridient->name;
////            $this->ing[$ingridient->id]['count'] = Recipe::where('ingridients', 'like', '%'.$ingridient->name.'%')->count();
////        }
//    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {

        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function openDelModal($sectionId, $text)
    {
        $this->selectedItem = $sectionId;
        $this->modText = $text;

        $this->dispatch('openDelModal');
    }

    public function closeDelModal()
    {
        $this->dispatch('closeDelModal');
    }

    public function destroy()
    {
        Ingredient::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function render()
    {
        $ing = Ingredient::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        foreach ($ing as $item) {
            $this->ing[$item->id]['name'] = $item->name;
            $this->ing[$item->id]['count'] = Recipe::where('ingridients', 'like', '%'.$item->name.'%')->count();
        }

        return view('livewire.spiski.ingredients.ingredients',
            [
                'ingredients' => $ing
            ]
        );
    }
}
