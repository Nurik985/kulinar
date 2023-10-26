<?php

namespace App\Livewire\Spiski\Cooks;

use App\Models\Cook;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateCooks extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Название должен содержать мин 3 символа')]
    #[Rule('unique:' . Cook::class . ',name', message: 'Такое название уже существует измените его')]
    public $name = '';
    public $coef;

    public function saveCook()
    {
        if ($this->coef == null) {
            $this->coef = 1;
        }

        $this->validate();

        Cook::create([
            'name' => $this->name,
            'coef' => $this->coef,
        ]);

        session()->flash('success', "Что готовим успшено добавлен");

        return redirect()->to(route('spisok.cook.index'));
    }

    public function render()
    {
        return view('livewire.spiski.cooks.create-cooks');
    }
}
