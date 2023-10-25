<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;


class SectionsTable extends Component
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

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

    public function openDelModal($sectionId, $title)
    {
        $this->selectedItem = $sectionId;
        $this->dispatch('openDelModal', title: $title);
    }

    public function closeDelModal()
    {
        $this->dispatch('closeDelModal');
    }

    public function updatedSearch()
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

    public function destroy()
    {
        Section::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function render()
    {
        return view(
            'livewire.sections-table',
            [
                'sections' => Section::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
