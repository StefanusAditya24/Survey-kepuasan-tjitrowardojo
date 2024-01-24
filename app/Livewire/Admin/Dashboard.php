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
        $this->dispatch('filter-update', $this->getMonthlyRespondent(), $this->getQuestionData());
    }

    private function updateRespondents(): void
    {
        $this->respondents = $this->respondentRepository->getRespondents(
            $this->filterDate == "" ? null : Carbon::createFromFormat('Y-m', $this->filterDate),
        );
    }

    #[Computed()]
    public function getMonthlyRespondent(): array
    {
        $data = [];
        $year = $this->filterDate == "" ? Carbon::now()->year : explode('-', $this->filterDate)[0];
        for ($i = 1; $i  <= 12; $i++) {
            $data[] = $this->respondentRepository->getRespondents(Carbon::createFromFormat('Y-m', "$year-$i"))->count();
        }
        return $data;
    }

    #[Computed()]
    public function getQuestionData(): array
    {
        $filterDate = $this->filterDate == "" ? null : Carbon::createFromFormat('Y-m', $this->filterDate);

        return $this->questions->map(function ($question) use ($filterDate) {
            return $this->respondentAnswerRepository->getAnswerCountByQuestionId($filterDate, $question->id);
        })->toArray();
    }


    #[Title('Dashboard')]
    public function render(): View
    {
        return view('livewire.admin.dashboard');
    }
}
