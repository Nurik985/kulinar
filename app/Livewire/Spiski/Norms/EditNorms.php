<?php

namespace App\Livewire\Spiski\Norms;

use App\Models\Norm;
use Livewire\Component;

class EditNorms extends Component
{
    public $name;
    public $value;
    public $id;

    protected function rules()
    {
        return [
            'name' => 'required|unique:' . Norm::class . ',name,' . $this->id,
            'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните обязательное поле',
            'value.required' => 'Пожалуйста заполните обязательное поле',
            'name.unique' => 'Такое название уже существет',
        ];
    }

    public function mount($normId)
    {
        $this->id = $normId;
        $norm = Norm::findOrFail($normId);
        $this->name = $norm->name;
        $this->weight = $norm->weight;
        $this->form_word = $norm->form_word;
    }

    public function updateNorm()
    {

        $this->validate();

        $met = Norm::find($this->id);

        $met->update([
            'name' => $this->name,
            'value' => $this->value,
        ]);

        session()->flash('success', "Дневная норма успшено обнавлен");
        return redirect()->to(route('spisok.norms.index'));
    }

    public function render()
    {
        return view('livewire.spiski.norms.edit-norms');
    }
}
