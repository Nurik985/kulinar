<?php

namespace App\Livewire\Spiski\Portions;

use App\Models\Portion;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreatePortions extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('unique:' . Portion::class . ',name', message: 'Такое название уже существует измените его')]
    public $name = '';

    public function savePortion()
    {
        $this->validate();

        Portion::create([
            'name' => $this->name,
        ]);

        session()->flash('success', "Порция успшено добавлен");

        return redirect()->to(route('spisok.portions.index'));
    }

    public function render()
    {
        return view('livewire.spiski.portions.create-portions');
    }
}
