<?php

namespace App\Livewire\Admin\Question;

use App\Models\Question;
use App\Repository\CategoryRepository;
use App\Repository\QuestionRepository;
use App\Repository\QuestionTypeRepository;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Form extends Component
{
    public Question $question;
    public Collection $questionCategories;
    public Collection $questionTypes;
    public string $name = "";
    public string $questionTypeId = "";
    public string $questionCategoryId = "";

    public function __construct(
        protected CategoryRepository $categoryRepository = new CategoryRepository(),
        protected QuestionRepository $questionRepository = new QuestionRepository(),
        protected QuestionTypeRepository $questionTypeRepository = new QuestionTypeRepository()

    ) {
    }

    public function mount(mixed $questionId = null): void
    {
        $this->questionCategories = $this->categoryRepository->getCategories();
        $this->questionTypes = $this->questionTypeRepository->getQuestionTypes();
        if (!is_null($questionId)) {
            $this->question = new Question();
            $this->question = $this->questionRepository->getQuestion($questionId);
            $this->name = $this->question->name;
            $this->questionTypeId = $this->question->question_type_id;
            $this->questionCategoryId = $this->question->category_id;
        }
    }

    public function save(): mixed
    {
        $model = $this->question;
        $this->name = $this->question->name;
        $this->questionTypeId = $this->question->question_type_id;
        $this->questionCategoryId = $this->question->category_id;
        $model->save();
        return redirect(route('question.index'))->with('status', "Berhasil");
    }

    #[Title('Question Form')]
    public function render(): View
    {
        return view('livewire.admin.question.form');
    }
}
