<?php

namespace App\Livewire\Recipes;

use App\Models\Recipe;
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
            'name' => 'Изменено',
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
        Recipe::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function render()
    {
        return view('livewire.recipes.recipes',
            [
                'recipes' => Recipe::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
