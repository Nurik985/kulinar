<?php

namespace App\Livewire\Spiski\Cooks;

use App\Models\Cook;
use Livewire\Component;

class EditCooks extends Component
{
    public $name;
    public $id;
    public $coef;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|unique:' . Cook::class . ',name,' . $this->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните обязательное поле',
            'name.min' => 'Название должен содержать мин 3 символа',
            'name.unique' => 'Такое название уже существет',
        ];
    }

    public function mount($cookId)
    {
        $this->id = $cookId;
        $cook = Cook::findOrFail($cookId);
        $this->name = $cook->name;
        $this->coef = $cook->coef;
    }

    public function updateCook()
    {

        $this->validate();

        $met = Cook::find($this->id);

        $met->update([
            'name' => $this->name,
            'coef' => $this->coef,
        ]);

        session()->flash('success', "Вид готовки успшено обнавлен");
        return redirect()->to(route('spisok.cook.index'));
    }

    public function render()
    {
        return view('livewire.spiski.cooks.edit-cooks');
    }
}
