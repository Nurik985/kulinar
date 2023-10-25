<?php

namespace App\Livewire\Spiski\Ingredients;

use App\Models\Ingredient;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditIngredients extends Component
{
    public $name;

    public $protein;
    public $fat;
    public $carbohydrates;
    public $kkal;
    public $fiber;
    public $water;
    public $id;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|unique:'.Ingredient::class.',name,' . $this->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните обязательное поле',
            'name.min' => 'Название должен содержать мин 3 символа',
        ];
    }

    public function mount($ingId){
        $this->id = $ingId;
        $ing = Ingredient::findOrFail($ingId);
        $this->name = $ing->name;
        $this->protein = $ing->protein;
        $this->fat = $ing->fat;
        $this->carbohydrates = $ing->carbohydrates;
        $this->kkal = $ing->kkal;
        $this->fiber = $ing->fiber;
        $this->water = $ing->water;
    }

    public function updateIngredient(){

        $this->validate();

        $ing = Ingredient::find($this->id);

        $ing->update([
            'name' => $this->name,
            'protein' => $this->protein,
            'fat' => $this->fat,
            'carbohydrates' => $this->carbohydrates,
            'kkal' => $this->kkal,
            'fiber' => $this->fiber,
            'water' => $this->water,
        ]);

        session()->flash('success', "Ингредиент успшено обнавлен");
        return redirect()->to(route('spisok.ings.index'));
    }

    public function render()
    {
        return view('livewire.spiski.ingredients.edit-ingredients');
    }
}
