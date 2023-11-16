<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PagesCreate extends Component
{
    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $name;

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    #[Rule('min:3', message: 'Поле должен содержать мин 3 символа')]
    #[Rule('regex:/^[a-zA-Z-]+$/u', message: 'ЧПУ должен содержать только латиницу')]
    #[Rule('unique:' . Page::class . ',url', message: 'Такой URL уже существует. Измените его')]
    public $url;

    #[Rule('required', message: 'Пожалуйста заполните обязательное поле')]
    public $title;

    public $text;
    public $status = 2;

    public function generateSlug()
    {
        $this->url = Str::slug($this->name);

        $this->validate();
    }

    public function savePage()
    {

        $this->validate();

        Page::create([
            'name' => $this->name,
            'title' => $this->title,
            'url' => $this->url,
            'text' => $this->text,
            'status' =>  $this->status,
        ]);

        session()->flash('success', "Страница успшено создан");

        return redirect()->to(route('pages.index'));
    }

    public function render()
    {
        return view('livewire.pages.pages-create');
    }
}
