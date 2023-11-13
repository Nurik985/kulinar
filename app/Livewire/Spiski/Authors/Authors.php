<?php

namespace App\Livewire\Spiski\Authors;

use App\Models\Author;
use App\Models\Recipe;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Authors extends Component
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
    public $aut;

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
        $aut = Author::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        foreach ($aut as $item) {
            $this->aut[$item->id]['name'] = $item->name;
            $this->aut[$item->id]['count'] = Recipe::where('author_id', '=', $item->id)->count();
            $this->aut[$item->id]['id'] = $item->id;
        }

        return view('livewire.spiski.authors.authors',
            [
                'authors' => $aut
            ]
        );
    }
}
