<?php

namespace App\Livewire\Admin\Question;

use App\Repository\QuestionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    public Collection $questionDatas;

    public function __construct(
        protected QuestionRepository $questionRepository = new QuestionRepository()
    ) {
    }

    public function mount(): void
    {
        $this->questionDatas =  $this->questionRepository->getQuestions();
    }

    public function delete(mixed $questionId): mixed
    {
        $question = $this->questionRepository->getQuestion($questionId);
        $question->delete();
        return redirect(route('question.index'))->with('status', "Berhasil");
    }

    #[Title('Pertanyaan')]
    public function render(): View
    {
        return view('livewire.admin.question.index');
    }
}
