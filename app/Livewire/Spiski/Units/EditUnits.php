<?php

namespace App\Livewire\Spiski\Units;

use App\Models\Unit;
use Livewire\Component;

class EditUnits extends Component
{
    public $name;
    public $weight;
    public $form_word;
    public $id;

    protected function rules()
    {
        return [
            'name' => 'required|unique:' . Unit::class . ',name,' . $this->id,
            'weight' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните обязательное поле',
            'weight.required' => 'Пожалуйста заполните обязательное поле',
            'name.unique' => 'Такое название уже существет',
        ];
    }

    public function mount($unitId)
    {
        $this->id = $unitId;
        $unit = Unit::findOrFail($unitId);
        $this->name = $unit->name;
        $this->weight = $unit->weight;
        $this->form_word = $unit->form_word;
    }

    public function updateUnit()
    {

        $this->validate();

        $met = Unit::find($this->id);

        $met->update([
            'name' => $this->name,
            'weight' => $this->weight,
            'form_word' => $this->form_word,
        ]);

        session()->flash('success', "Единица измерения успшено обнавлен");
        return redirect()->to(route('spisok.units.index'));
    }

    public function render()
    {
        return view('livewire.spiski.units.edit-units');
    }
}
