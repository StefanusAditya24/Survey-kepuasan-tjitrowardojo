<?php

namespace App\Livewire\Admin\Question;

use App\Models\Question;
use App\Repository\QuestionRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Form extends Component
{
    public $questionModel;
    public string $name = "";

    public function __construct(
        protected QuestionRepository $questionRepository = new QuestionRepository(),

    ) {
    }

    public function mount(mixed $questionId = null): void
    {
        $this->questionModel = new Question();
        if (!is_null($questionId)) {
            $this->questionModel = $this->questionRepository->getQuestion($questionId);
            $this->name = $this->questionModel->name;
        }
    }

    public function save(): mixed
    {
        $model = $this->questionModel;
        $model->name = $this->name;
        $model->save();
        return redirect(route('question.index'))->with('status', "Berhasil");
    }

    #[Title('Question Form')]
    public function render(): View
    {
        return view('livewire.admin.question.form');
    }
}
