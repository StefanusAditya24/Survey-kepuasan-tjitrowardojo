<?php

namespace App\Livewire\Admin\Respondent;

use App\Repository\QuestionRepository;
use App\Repository\RespondentRepository;
use Illuminate\View\View;
use Livewire\Component;

class Detail extends Component
{
    public string $name = "";
    public string $phoneNumber = "";
    public string $gender = "";
    public string $age = "";
    public string $education = "";
    public string $job = "";
    public string $serviceType = "";
    public $answers = [];
    public $questions = [];

    public function __construct(
        protected RespondentRepository $respondentRepository = new RespondentRepository(),
        protected QuestionRepository $questionRepository = new QuestionRepository(),
    ) {
    }

    public function mount(mixed $respondentId): void
    {
        $respondentData = $this->respondentRepository->getRespondent($respondentId);
        $this->name = $respondentData->name;
        $this->phoneNumber = $respondentData->phone_number;
        $this->gender = $respondentData->gender;
        $this->age = $respondentData->age->name;
        $this->education = $respondentData->education->name;
        $this->job = $respondentData->job;
        $this->serviceType = $respondentData->serviceType->name;

        $respondentData->answers->each(function ($answer) {
            $this->questions[] = $this->questionRepository->getQuestion($answer->question_id);
            $this->answers[] = $answer->answer;
        });
    }

    public function render(): View
    {
        return view('livewire.admin.respondent.detail');
    }
}
