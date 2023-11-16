<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;

class PagesEdit extends Component
{
    public $id;

    public $url;
    public $title;
    public $name;
    public $text;
    public $status;

    protected function rules()
    {
        return [
            'url' => 'required|min:3|regex:/^[a-zA-Z1-9-]+$/u|unique:' . Page::class . ',url,' . $this->id,
            'title' => 'required',
            'name' => 'required',
        ];
    }

    public function generateSlug()
    {
        $this->url = Str::slug($this->name);
    }

    public function messages()
    {
        return [
            'url.required' => 'Пожалуйста заполните обязательное поле',
            'url.min' => 'Название должен содержать мин 3 символа',
            'url.regex' => 'ЧПУ должен содержать только латиницу',
            'title.required' => 'Пожалуйста заполните обязательное поле',
            'name.required' => 'Пожалуйста заполните обязательное поле',
        ];
    }

    public function mount($pageId)
    {
        $this->id = $pageId;
        $page = Page::findOrFail($pageId);
        $this->url = $page->url;
        $this->title = $page->title;
        $this->name = $page->name;
        $this->text = $page->text;
        $this->status = $page->status;
    }

    public function updatePage()
    {

        $this->validate();

        $page = Page::find($this->id);

        $page->update([
            'url' => $this->url,
            'title' => $this->title,
            'name' => $this->name,
            'text' => $this->text,
            'status' => $this->status,
        ]);

        session()->flash('success', "Страница успшено обнавлен");
        return redirect()->to(route('pages.index'));
    }

    public function render()
    {
        return view('livewire.pages.pages-edit');
    }
}
