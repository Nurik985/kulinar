<?php

namespace App\Livewire\Spiski\Ingredients;

use App\Models\Ingredient;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateIngredients extends Component
{

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Название должен содержать мин 3 символа')]
    #[Rule('unique:'.Ingredient::class.',name', message: 'Такое название уже существует измените его')]
    public $name = '';

    public $kkal;
    public $fat;
    public $protein;
    public $carbohydrates;
    public $fiber;
    public $water;

    public function saveIngredient(){

        $this->validate();

        Ingredient::create([
            'name' => $this->name,
            'protein' => $this->protein,
            'kkal' => $this->kkal,
            'fat' => $this->fat,
            'carbohydrates' => $this->carbohydrates,
            'fiber' => $this->fiber,
            'water' => $this->water,
        ]);

        session()->flash('success', "Ингредиент успшено добавлен");

        return redirect()->to(route('spisok.ings.index'));
    }

    public function render()
    {
        return view('livewire.spiski.ingredients.create-ingredients');
    }
}
