<?php

namespace App\Livewire\Spiski\Portions;

use App\Models\Portion;
use Livewire\Component;

class EditPortions extends Component
{
    public $name;
    public $id;

    protected function rules()
    {
        return [
            'name' => 'required|unique:' . Portion::class . ',name,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните обязательное поле',
            'name.unique' => 'Такое название уже существет',
        ];
    }

    public function mount($portionId)
    {
        $this->id = $portionId;
        $portion = Portion::findOrFail($portionId);
        $this->name = $portion->name;
    }

    public function updatePortion()
    {

        $this->validate();

        $met = Portion::find($this->id);

        $met->update([
            'name' => $this->name,
        ]);

        session()->flash('success', "Порция успшено обнавлен");
        return redirect()->to(route('spisok.portions.index'));
    }

    public function render()
    {
        return view('livewire.spiski.portions.edit-portions');
    }
}
