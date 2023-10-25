<?php

namespace App\Livewire\Spiski\Kitchens;


use App\Models\Kitchen;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateKitchen extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Название должен содержать мин 3 символа')]
    #[Rule('unique:'.Kitchen::class.',name', message: 'Такое название уже существует измените его')]
    public $name = '';

    public function saveKitchen(){

        $this->validate();

        Kitchen::create([
            'name' => $this->name,
        ]);

        session()->flash('success', "Кухня успшено добавлен");

        return redirect()->to(route('spisok.kitchen.index'));
    }

    public function render()
    {
        return view('livewire.spiski.kitchens.create-kitchen');
    }
}
