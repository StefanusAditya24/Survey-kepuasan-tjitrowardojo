<?php

namespace App\Livewire\Admin\Question;

use App\Models\Question;
use App\Models\QuestionAnswer;
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
    public QuestionAnswer $questionAnswer;
    public Collection $questionCategories;
    public Collection $questionTypes;
    public string $name = "";
    public string $questionTypeId = "";
    public string $questionCategoryId = "";
    public string $selectedQuestionType = "";
    public array $weightedAnswers = [];

    public function __construct(
        protected CategoryRepository     $categoryRepository = new CategoryRepository(),
        protected QuestionRepository     $questionRepository = new QuestionRepository(),
        protected QuestionTypeRepository $questionTypeRepository = new QuestionTypeRepository()

    )
    {
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
        $this->weightedAnswers[] = [
            'answer' => '',
            'answer_value' => '',
            'question_id' => '',
        ];
    }

    public function save(): mixed
    {
        $question = $this->question;
        $question->name = $this->name;
        $question->question_type_id = $this->questionTypeId;
        $question->category_id = $this->questionCategoryId;
        $question->save();

        $questionAnswer = $this->questionAnswer;
        foreach ($this->weightedAnswers as $weightedAnswer) {
            $questionAnswer->answer = $weightedAnswer['answer'];
            $questionAnswer->answer_value = $weightedAnswer['answer_value'];
            $questionAnswer->question_id = $weightedAnswer['answer_value'];
            $questionAnswer->save();
        }

        return redirect(route('question.index'))->with('status', "Berhasil");
    }

    public function selectQuestionType(string $serviceType, ?string $questionId = ''): void
    {
        $data = json_decode($serviceType, true);
        if ($data) {
            $weightData = [];
            $this->questionTypeId = $data['id'];
            $this->selectedQuestionType = $data['type'];

            $answerOptions = match ($data['type']) {
                "Multiple Choice" => [
                    ['answer' => 'Sangat baik', 'answer_value' => '4'],
                    ['answer' => 'Baik', 'answer_value' => '3'],
                    ['answer' => 'Cukup', 'answer_value' => '2'],
                    ['answer' => 'Kurang', 'answer_value' => '1'],
                ],
                "Polar Question" => [
                    ['answer' => 'Yes', 'answer_value' => '1'],
                    ['answer' => 'No', 'answer_value' => '0'],
                    ['answer' => 'Others', 'answer_value' => '0'],
                ],
                "Open Ended Question" => [
                    ['answer' => 'Lainnya', 'answer_value' => '0'],
                ],
                default => [],
            };

            foreach ($answerOptions as $option) {
                $weightData[] = [
                    'answer' => $option['answer'],
                    'answer_value' => $option['answer_value'],
                    'question_id' => $questionId,
                ];
            }

            $this->weightedAnswers = $weightData;
        }
    }

    #[Title('Question Form')]
    public function render(): View
    {
        return view('livewire.admin.question.form');
    }
}
