<?php

namespace App\Livewire\Spiski\Norms;

use App\Models\Norm;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateNorms extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('unique:' . Norm::class . ',name', message: 'Такое название уже существует измените его')]
    public $name = '';

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $value = '';

    public function saveNorm()
    {
        $this->validate();

        Norm::create([
            'name' => $this->name,
            'value' => $this->value,
        ]);

        session()->flash('success', "Дневная норма успшено добавлен");

        return redirect()->to(route('spisok.norms.index'));
    }

    public function render()
    {
        return view('livewire.spiski.norms.create-norms');
    }
}
