<?php

namespace App\Livewire\Sections;

use App\Models\Section;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateSection extends Component
{

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $title;

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Поле должен содержать мин 3 символа')]
    #[Rule('regex:/^[a-zA-Z-]+$/u', message: 'ЧПУ должен содержать только латиницу')]
    #[Rule('unique:'.Section::class.',url', message: 'Такой URL уже существует. Измените его')]
    public $url;

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $h1;

    public $description;
    public $text;
    public $fade_home;

    public function generateSlug(){
        $this->url = Str::slug($this->h1);
    }

    public function saveSection(){

        $this->validate();

        if($this->fade_home == null){
            $this->fade_home = 'off';
        } else {
            $this->fade_home = 'on';
        }

        Section::create([
            'h1' => $this->h1,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'text' => $this->text,
            'fade_home' =>  $this->fade_home,
        ]);

        session()->flash('success', "Раздел успшено создан");

        return redirect()->to(route('razdel.index'));
    }

    public function render()
    {
        return view('livewire.sections.create-section');
    }
}
