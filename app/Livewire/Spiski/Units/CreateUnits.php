<?php

namespace App\Livewire\Spiski\Units;

use App\Models\Unit;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateUnits extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('unique:' . Unit::class . ',name', message: 'Такое название уже существует измените его')]
    public $name = '';

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $weight = '';

    public $form_word;

    public function saveUnit()
    {
        $this->validate();

        Unit::create([
            'name' => $this->name,
            'weight' => $this->weight,
            'form_word' => $this->form_word,
        ]);

        session()->flash('success', "Единица измерения успшено добавлен");

        return redirect()->to(route('spisok.units.index'));
    }

    public function render()
    {
        return view('livewire.spiski.units.create-units');
    }
}
