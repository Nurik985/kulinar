<?php

namespace App\Livewire\Sections;

use App\Models\Section;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditSection extends Component
{

    public $id;

    public $url;
    public $title;
    public $h1;
    public $description;
    public $text;
    public $fade_home;

    protected function rules()
    {
        return [
            'url' => 'required|min:3|regex:/^[a-zA-Z-]+$/u|unique:' . Section::class . ',url,' . $this->id,
            'title' => 'required',
            'h1' => 'required',
        ];
    }

    public function generateSlug()
    {
        $this->url = Str::slug($this->h1);
    }

    public function messages()
    {
        return [
            'url.required' => 'Пожалуйста заполните обязательное поле',
            'url.min' => 'Название должен содержать мин 3 символа',
            'url.regex' => 'ЧПУ должен содержать только латиницу',
            'title.required' => 'Пожалуйста заполните обязательное поле',
            'h1.required' => 'Пожалуйста заполните обязательное поле',
        ];
    }

    public function mount($secId)
    {
        $this->id = $secId;
        $sec = Section::findOrFail($secId);
        $this->url = $sec->url;
        $this->title = $sec->title;
        $this->h1 = $sec->h1;
        $this->description = $sec->description;
        $this->text = $sec->text;
        $this->fade_home = $sec->fade_home;
    }

    public function updateIngredient()
    {

        $this->validate();

        if ($this->fade_home == null) {
            $this->fade_home = 'false';
        } else {
            $this->fade_home = 'true';
        }

        $ing = Section::find($this->id);

        $ing->update([
            'url' => $this->url,
            'title' => $this->title,
            'h1' => $this->h1,
            'description' => $this->description,
            'text' => $this->text,
            'fade_home' => $this->fade_home,
        ]);

        session()->flash('success', "Раздел успшено обнавлен");
        return redirect()->to(route('razdel.index'));
    }

    public function render()
    {
        return view('livewire.sections.edit-section');
    }
}
