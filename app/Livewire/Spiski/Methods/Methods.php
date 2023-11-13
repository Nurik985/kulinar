<?php

namespace App\Livewire\Spiski\Methods;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Method;

class Methods extends Component
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
    public $met;

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
        Method::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function render()
    {
        $met = Method::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        foreach ($met as $item) {
            $this->met[$item->id]['name'] = $item->name;
            $this->met[$item->id]['count'] = Recipe::where('method', 'like', '%'.$item->name.'%')->count();
        }

        return view(
            'livewire.spiski.methods.methods',
            [
                'methods' => $met
            ]
        );
    }
}
