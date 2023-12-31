<?php

namespace App\Livewire\Redirects;

use App\Models\Redirect;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Redirects extends Component
{
    public $selectedItem = 0;
    public $delRedirect = false;
    public $mod = 'delMod';
    public $old;
    public $new;

    public function destroy()
    {
        $this->delRedirect = false;
        Redirect::destroy($this->selectedItem);
        $this->dispatch('closeDelModal');
    }

    public function openDelModal($sectionId)
    {
        if($sectionId){
            $this->delRedirect = true;
            $this->selectedItem = $sectionId;
        }

        $this->dispatch('openDelModal');
    }

    public function closeDelModal()
    {
        $this->delRedirect = false;
        $this->dispatch('closeDelModal');
    }

    public function saveRedirect(){
        Redirect::create([
            'old-url' => $this->old,
            'new-url' => $this->new,
        ]);

        $this->reset();

        session()->flash('success', "Редирект успешно добавлен");

    }

    public function render()
    {
        return view('livewire.redirects.redirects',
            [
                'redirects' => Redirect::all()->sortByDesc("created_at")
            ]
        );
    }
}
