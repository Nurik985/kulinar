<?php

namespace App\Livewire\Spiski\Methods;

use Livewire\Component;
use App\Models\Method;

class EditMethods extends Component
{
    public $name;
    public $id;
    public $coef;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|unique:' . Method::class . ',name,' . $this->id
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

    public function mount($metId)
    {
        $this->id = $metId;
        $met = Method::findOrFail($metId);
        $this->name = $met->name;
        $this->coef = $met->coef;
    }

    public function updateMethod()
    {

        $this->validate();

        $met = Method::find($this->id);

        $met->update([
            'name' => $this->name,
            'coef' => $this->coef,
        ]);

        session()->flash('success', "Способ приготовления успшено обнавлен");
        return redirect()->to(route('spisok.method.index'));
    }

    public function render()
    {
        return view('livewire.spiski.methods.edit-methods');
    }
}
