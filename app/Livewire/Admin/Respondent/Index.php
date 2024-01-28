<?php

namespace App\Livewire\Admin\Respondent;

use App\Exports\RespondentExport;
use App\Repository\QuestionRepository;
use App\Repository\RespondentAnswerRepository;
use App\Repository\RespondentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Index extends Component
{
    public Collection $respondentDatas;
    public ?Carbon $startFilterDate;
    public ?Carbon $endFilterDate;
    public string $selectedFilter = "single";
    use WithFileUploads;

    public function __construct(
        protected RespondentRepository       $respondentRepository = new RespondentRepository(),
        protected QuestionRepository         $questionRepository = new QuestionRepository(),
        protected RespondentAnswerRepository $respondentAnswerRepository = new RespondentAnswerRepository(),
    )
    {
    }

    public function mount(): void
    {
        $this->getFilteredRespondents();
    }

    public function updatedSelectedFilter(): void
    {
        $this->getFilteredRespondents();
    }

    public function updatedStartFilterDate(): void
    {
        $this->getFilteredRespondents();
    }

    public function updatedEndFilterDate(): void
    {
        $this->getFilteredRespondents();
    }

    private function getFilteredRespondents(): void
    {
        $this->respondentDatas = $this->getRespondents(false, false)['respondents'];
    }

    public function delete(mixed $respondentId): mixed
    {
        $respondent = $this->respondentRepository->getRespondent($respondentId);
        $respondent->delete();
        return redirect(route('respondent.index'))->with('status', "Berhasil");
    }

    public function export(): BinaryFileResponse
    {
        $currentDate = Carbon::now();
        $currentDate->format('d-m-Y');

        return Excel::download(new RespondentExport(
            $this->getRespondents(true, false)['respondents'],
            $this->getRespondents(false, true)['respondents'],
            $this->questionRepository->getQuestions(true),
            $this->questionRepository->getQuestions(false, true),
            $this->getRespondents(true, false)['respondentAnswers'],
            $this->getRespondents(true, false)['respondentAnswers']
        ), "Respondent_$currentDate.xlsx");
    }

    #[Title('Respondent')]
    public function render(): View
    {
        return view('livewire.admin.respondent.index');
    }

    private function getRespondents(bool $onlyMultiple, bool $excludeMultiple): array
    {
        $currentDate = Carbon::now();

        $firstDayOfMonth = $currentDate->copy()->startOfMonth();
        $lastDayOfMonth = $currentDate->copy()->endOfMonth();

        switch ($this->selectedFilter) {
            case "single":
                $this->startFilterDate = $firstDayOfMonth;
                $this->endFilterDate = $lastDayOfMonth;
                break;

            case "triple":
                $this->startFilterDate = $currentDate->copy()->subMonths(3)->startOfMonth();
                $this->endFilterDate = $lastDayOfMonth;
                break;

            case "year":
                $this->startFilterDate = $currentDate->copy()->startOfYear();
                $this->endFilterDate = $currentDate->copy()->endOfYear();
                break;

            case "all":
                $this->startFilterDate = null;
                $this->endFilterDate = null;
        }

        return [
            'respondents' => $this->respondentRepository->getRespondents($this->startFilterDate, $this->endFilterDate, true, $onlyMultiple, $excludeMultiple),
            'respondentAnswers' => $this->respondentAnswerRepository->getRespondentAnswerIndex($this->startFilterDate, $this->endFilterDate, $onlyMultiple, $excludeMultiple)
        ];
    }
}
