<?php

namespace App\Livewire\Spiski\Kitchens;

use App\Models\Kitchen;
use Livewire\Component;

class EditKitchen extends Component
{
    public $name;
    public $id;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|unique:'.Kitchen::class.',name,' . $this->id
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

    public function mount($kitId){
        $this->id = $kitId;
        $kit = Kitchen::findOrFail($kitId);
        $this->name = $kit->name;
    }

    public function updateKitchen(){

        $this->validate();

        $ing = Kitchen::find($this->id);

        $ing->update([
            'name' => $this->name,
        ]);

        session()->flash('success', "Кухня успшено обнавлен");
        return redirect()->to(route('spisok.kitchen.index'));
    }

    public function render()
    {
        return view('livewire.spiski.kitchens.edit-kitchen');
    }
}
