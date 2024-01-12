<?php

namespace App\Livewire\Admin;

use App\Repository\QuestionRepository;
use App\Repository\RespondentAnswerRepository;
use App\Repository\RespondentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    public string $filterDate = "";
    public Collection $respondents;
    public Collection $questions;

    public function __construct(
        protected RespondentRepository $respondentRepository = new RespondentRepository(),
        protected QuestionRepository $questionRepository = new QuestionRepository(),
        protected RespondentAnswerRepository $respondentAnswerRepository = new RespondentAnswerRepository()
    ) {
    }

    public function mount(): void
    {
        $this->questions = $this->questionRepository->getQuestions();
        $this->updateRespondents();
    }

    public function updated(): void
    {
        $this->updateRespondents();
        $this->dispatch('filter-update', $this->getMontlyRespondent(), $this->getQuestionData());
    }

    private function updateRespondents(): void
    {
        $this->respondents = $this->respondentRepository->getRespondents(
            $this->filterDate == "" ? null : Carbon::createFromFormat('Y-m', $this->filterDate),
        );
    }

    #[Computed()]
    public function getMontlyRespondent(): array
    {
        $data = [];
        for ($i = 1; $i  <= 12; $i++) {
            $year = $this->filterDate == "" ? Carbon::now()->year : explode('-', $this->filterDate)[0];
            $data[] = $this->respondentRepository->getRespondents(Carbon::createFromFormat('Y-m', "$year-$i"))->count();
        }
        return $data;
    }

    #[Computed()]
    public function getQuestionData(): array
    {
        $data = [];
        foreach ($this->questions as $question) {
            $filterDate = $this->filterDate == "" ? null : Carbon::createFromFormat('Y-m', $this->filterDate);
            $data[] =  $this->respondentAnswerRepository->getAnswerCountByQuestionId($filterDate, $question->id);
        }
        return $data;
    }


    #[Title('Dashboard')]
    public function render(): View
    {
        return view('livewire.admin.dashboard');
    }
}
