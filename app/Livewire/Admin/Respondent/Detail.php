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
    public array $answers = [];
    public array $questions = [];

    public function __construct(
        protected RespondentRepository $respondentRepository = new RespondentRepository(),
        protected QuestionRepository $questionRepository = new QuestionRepository(),
    ) {
    }

    public function mount(mixed $respondentId): void
    {
        $respondent = $this->respondentRepository->getRespondent($respondentId);
        $this->name = $respondent->name;
        $this->phoneNumber = $respondent->phone_number;
        $this->gender = $respondent->gender;
        $this->age = $respondent->age->name;
        $this->education = $respondent->education->name;
        $this->job = $respondent->job;
        $this->serviceType = $respondent->serviceType->name;

//        dd($respondent->answers[0]->answer->answer ?? $respondent->answers[0]->custom_answer);



        $respondent->answers->each(function ($answer) {
            $question = $this->questionRepository->getQuestion($answer->question_id);
            $answerValue = !empty($answer->custom_answer) ? $answer->custom_answer : $answer->answer->answer;
            $this->questions[] = $question;
            $this->answers[] = $answerValue;
        });

    }

    public function render(): View
    {
        return view('livewire.admin.respondent.detail');
    }
}
