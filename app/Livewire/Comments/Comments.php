<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    #[Url()]
    public $sortBtn = [0,1,2];

    public $selectedItem = 0;
    public $modText;

    public $statusAll;
    public $statusWaiting;
    public $statusApproved;
    public $statusBasket;
    public $event;

    public $selectAll = false;
    public $selected = [];
    public $pageIds = [];

    public function mount()
    {
        $this->statusAll = Comment::all()->count();
        $this->statusWaiting = Comment::where('status', '=', 0)->count();
        $this->statusApproved = Comment::where('status', '=', 1)->count();
        $this->statusBasket = Comment::where('status', '=', 2)->count();
    }

    public function updatedSelectAll($value)
    {
        if($value){
            $this->selected = $this->pageIds;
        } else {
            $this->selected = [];
        }
    }

    public function statusBtn($k){
        if($k == 'all'){
            $this->sortBtn = [];
            $this->sortBtn = [0,1,2];
        } else {
            $this->sortBtn = [];
            $this->sortBtn[] = $k;
        }

        $this->resetPage();
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

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->pageIds = [];
        $this->selected = [];
        $this->selectAll = false;
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

    public function destroy()
    {
        Comment::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');

        $this->statusAll = Comment::all()->count();
        $this->statusWaiting = Comment::where('status', '=', 0)->count();
        $this->statusApproved = Comment::where('status', '=', 1)->count();
        $this->statusBasket = Comment::where('status', '=', 2)->count();
    }

    public function clearBasket()
    {
        foreach ($this->selected as $item) {
            Comment::where('id', '=', $item)->delete();
        }

        $this->pageIds = [];
        $this->selected = [];
        $this->selectAll = false;

        $this->event = 'default';

        $this->statusAll = Comment::all()->count();
        $this->statusWaiting = Comment::where('status', '=', 0)->count();
        $this->statusApproved = Comment::where('status', '=', 1)->count();
        $this->statusBasket = Comment::where('status', '=', 2)->count();
    }

    public function eventClick()
    {
        foreach ($this->selected as $item) {
            if($this->event == 'waiting'){
                Comment::where('id', '=', $item)->update(['status' => 0]);
            }
            if($this->event == 'approved'){
                Comment::where('id', '=', $item)->update(['status' => 1]);
            }
            if($this->event == 'basket'){
                Comment::where('id', '=', $item)->update(['status' => 2]);
            }
        }

        $this->event = 'default';
        $this->pageIds = [];
        $this->selected = [];
        $this->selectAll = false;

        $this->statusAll = Comment::all()->count();
        $this->statusWaiting = Comment::where('status', '=', 0)->count();
        $this->statusApproved = Comment::where('status', '=', 1)->count();
        $this->statusBasket = Comment::where('status', '=', 2)->count();
    }

    public function render()
    {
        $search = Comment::search($this->search)
            ->whereIn('status', $this->sortBtn)
            ->paginate($this->perPage);

        $this->pageIds = [];
        foreach ($search as $s) {
            $this->pageIds[] = $s->id;
        }

        return view('livewire.comments.comments',
            [
                'comments' => $search
            ]
        );
    }
}
