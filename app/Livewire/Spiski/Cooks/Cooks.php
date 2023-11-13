<?php

namespace App\Livewire\Spiski\Cooks;

use App\Models\Cook;
use App\Models\Recipe;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Cooks extends Component
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
    public $coo;

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
        Cook::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function render()
    {
        $coo = Cook::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        foreach ($coo as $item) {
            $this->coo[$item->id]['name'] = $item->name;
            $this->coo[$item->id]['count'] = Recipe::where('w_cook', 'like', '%'.$item->name.'%')->count();
        }

        return view('livewire.spiski.cooks.cooks',
            [
                'cooks' => $coo
            ]
        );
    }
}
