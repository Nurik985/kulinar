<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Recipes extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'updated_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public $selectedItem = 0;
    public $modText;

    public $statusDraft = 0; // status - 2
    public $statusPending = 0; // status - 6
    public $statusPublished = 0; // status - 1
    public $statusBasket = 0; // status - 4

    #[Url()]
    public $sortBtn = 1;

    public $rowSows = [
        [
            'name' => 'Заголовок',
            'status' => true
        ],
        [
            'name' => 'Дата публикации',
            'status' => true
        ],
        [
            'name' => 'Дата изменения',
            'status' => true
        ],
        [
            'name' => 'Рейтинг',
            'status' => true
        ],
        [
            'name' => 'Количество шагов',
            'status' => true
        ],
        [
            'name' => 'Кухня',
            'status' => false
        ],
        [
            'name' => 'Статус',
            'status' => false
        ],
        [
            'name' => 'Проверил',
            'status' => false
        ],
        [
            'name' => 'Одобрил',
            'status' => false
        ],
        [
            'name' => 'Автор',
            'status' => false
        ],
        [
            'name' => 'Время готовки',
            'status' => false
        ],
        [
            'name' => 'Время приготовления',
            'status' => false
        ],
        [
            'name' => 'Порции',
            'status' => false
        ],
        [
            'name' => 'Что готовим',
            'status' => false
        ],
        [
            'name' => 'Способ приготовления',
            'status' => false
        ],
        [
            'name' => 'Рубрика',
            'status' => false
        ],
        [
            'name' => 'Калорий',
            'status' => false
        ]
    ];

    public function mount(){
        $recipes = DB::table('recipes')->select('id', 'status')->get();
        $this->statusDraft = $recipes->where('status', '=', 2)->count();
        $this->statusPending = $recipes->where('status', '=', 6)->count();
        $this->statusPublished = $recipes->where('status', '=', 1)->count();
        $this->statusBasket = $recipes->where('status', '=', 4)->count();

    }

    public function statusBtn($k){
        $this->sortBtn = $k;
        $this->resetPage();
    }

    public function rowShowRender($row){
        if($this->rowSows[$row]['status']){
            $this->rowSows[$row]['status'] = false;
        } else {
            $this->rowSows[$row]['status'] = true;
        }
    }

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

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

        if ($this->sortBy == $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'DESC';
        }

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

    public function recover($recipId)
    {
        $updateRecipe = Recipe::find($recipId);
        $updateRecipe->update([
            'status' => 2,
        ]);

        forceRecipeAll($this->selectedItem);
        session()->flash('success', "Рецепт успшено восстановлен со статусом черновик");

        return redirect()->to(route('recipe.index'));
    }

    public function basket($recipId)
    {
        $updateRecipe = Recipe::find($recipId);
        $updateRecipe->update([
            'status' => 4,
        ]);


        forceRecipeAllRemove($recipId);
        session()->flash('success', "Рецепт успшено отправлен в корзину");

        return redirect()->to(route('recipe.index'));
    }

    public function destroy()
    {
        $updateRecipe = Recipe::find($this->selectedItem);

        $updateRecipe->update([
            'status' => 4,
        ]);

        forceRecipeAll($this->selectedItem);

        $recipes = DB::table('recipes')->select('id', 'status')->get();
        $this->statusDraft = $recipes->where('status', '=', 2)->count();
        $this->statusPending = $recipes->where('status', '=', 6)->count();
        $this->statusPublished = $recipes->where('status', '=', 1)->count();
        $this->statusBasket = $recipes->where('status', '=', 4)->count();


        //$this->reset();

        //Recipe::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function clearBasket()
    {
        DB::table('recipes')->where('status', 4)->delete();

        $this->statusBasket = 0;
    }

    public function render()
    {
        return view('livewire.recipes.recipes',
            [
                'recipes' => Recipe::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->where('status', '=', $this->sortBtn)
                    ->paginate($this->perPage)
            ]
        );
    }
}
