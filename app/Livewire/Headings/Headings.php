<?php

namespace App\Livewire\Headings;

use App\Models\Heading;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Headings extends Component
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
        $heading = Heading::find($this->selectedItem);
        if($heading->img){
            Storage::delete($heading->img);
        }
        $heading->delete();
        $this->dispatch('closeDelModal');
        session()->flash('success', "Рубрика успшено удален");
        $this->resetPage();
    }

    public function render()
    {
        return view(
            'livewire.headings.headings',
            [
                'headings' => Heading::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
