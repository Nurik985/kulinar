<?php

namespace App\Livewire\Messages;

use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url()]
    public $perPage = 10;

    public $selectedItem = 0;
    public $modText;
    public $recipe;
    public $statusOne;
    public $statusTwo;
    public $statusThree;
    public $statusFour;

    public $status = 1;
    public $sortBtn = 1;
    public $selectAll = false;
    public $selected = [];
    public $pageIds = [];


    public function mount(){

        $this->statusOne = DB::table('messages')->where('status', '=', 1)->where('for_user', '=', '0')->count();
        $this->statusTwo = DB::table('messages')->where('status', '=', 1)->where('for_user', '=', '0')->where('title', '=', 'Cообщение об ошибке')->count();
        $this->statusThree = DB::table('messages')->where('status', '=', 2)->where('for_user', '=', '0')->count();
        $this->statusFour = DB::table('messages')->where('from_user', '=', '0')->count();
    }

    public function statusBtn($k){
        $this->status = $k;
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

    public function updatedSelectAll($value)
    {
        if($value){
            $this->selected = $this->pageIds;
        } else {
            $this->selected = [];
        }
    }

    public function messageFunc($messId, $event)
    {
        if($event == 'delete'){
            Message::where('id', '=', $messId)->delete();
        }

        $this->statusOne = DB::table('messages')->where('status', '=', 1)->where('for_user', '=', '0')->count();
        $this->statusTwo = DB::table('messages')->where('status', '=', 1)->where('for_user', '=', '0')->where('title', '=', 'Cообщение об ошибке')->count();
        $this->statusThree = DB::table('messages')->where('status', '=', 2)->where('for_user', '=', '0')->count();
        $this->statusFour = DB::table('messages')->where('from_user', '=', '0')->count();

    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function destroy()
    {
        Message::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');

        $this->statusOne = DB::table('messages')->where('status', '=', 1)->where('for_user', '=', '0')->count();
        $this->statusTwo = DB::table('messages')->where('status', '=', 1)->where('for_user', '=', '0')->where('title', '=', 'Cообщение об ошибке')->count();
        $this->statusThree = DB::table('messages')->where('status', '=', 2)->where('for_user', '=', '0')->count();
        $this->statusFour = DB::table('messages')->where('from_user', '=', '0')->count();
    }

    public function openDelModal($messId, $text)
    {
        $this->selectedItem = $messId;
        $this->modText = $text;

        $this->dispatch('openDelModal');
    }

    public function closeDelModal()
    {
        $this->dispatch('closeDelModal');
    }

    public function render()
    {

        if($this->status == 1){
            $this->sortBtn = 1;
            $search = Message::search($this->search)
                ->where('status', '=', 1)
                ->where('for_user', '=', '0')
                ->paginate($this->perPage);
        }

        if($this->status == 2){
            $this->sortBtn = 2;
            $search = Message::search($this->search)
                ->where('status', '=', 1)
                ->where('for_user', '=', '0')
                ->where('title', '=', 'Cообщение об ошибке')
                ->paginate($this->perPage);
        }

        if($this->status == 3){
            $this->sortBtn = 3;
            $search = Message::search($this->search)
                ->where('status', '=', 2)
                ->where('for_user', '=', '0')
                ->paginate($this->perPage);
        }

        if($this->status == 4){
            $this->sortBtn = 4;
            $search = Message::search($this->search)
                ->where('from_user', '=', '0')
                ->paginate($this->perPage);
        }

        $this->pageIds = [];
        foreach ($search as $s) {
            $this->pageIds[] = $s->id;
        }

        return view('livewire.messages.messages',
            [
                'messages' => $search
            ]
        );
    }
}
