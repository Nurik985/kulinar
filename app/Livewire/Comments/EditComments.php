<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Section;
use Livewire\Component;

class EditComments extends Component
{
    public $id;
    public $comment;
    public $answer;
    public $name;
    public $email;

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните обязательное поле',
            'email.required' => 'Пожалуйста заполните обязательное поле',
        ];
    }

    public function mount($commentId)
    {
        $this->id = $commentId;
        $com = Comment::findOrFail($commentId);
        $this->name = trim($com->name_user);
        $this->email = trim($com->email);
        $this->comment = trim($com->text);
        $this->answer = trim($com->answer);
    }

    public function updateComment()
    {

        $this->validate();

        $ing = Comment::find($this->id);

        $ing->update([
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->comment,
            'answer' => $this->answer,
        ]);

        session()->flash('success', "Комментарий успшено обнавлен");
        return redirect()->to(route('comments.index'));
    }

    public function render()
    {
        return view('livewire.comments.edit-comments');
    }
}
