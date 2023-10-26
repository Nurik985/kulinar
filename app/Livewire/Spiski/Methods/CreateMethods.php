<?php

namespace App\Livewire\Spiski\Methods;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Method;

class CreateMethods extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Название должен содержать мин 3 символа')]
    #[Rule('unique:' . Method::class . ',name', message: 'Такое название уже существует измените его')]
    public $name = '';
    public $coef;

    public function saveMethod()
    {
        if ($this->coef == null) {
            $this->coef = 1;
        }

        $this->validate();

        Method::create([
            'name' => $this->name,
            'coef' => $this->coef,
        ]);

        session()->flash('success', "Способ приготовления успшено добавлен");

        return redirect()->to(route('spisok.method.index'));
    }

    public function render()
    {
        return view('livewire.spiski.methods.create-methods');
    }
}
