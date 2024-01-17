<?php

namespace App\Livewire\Admin\Respondent;

use App\Exports\RespondentExport;
use App\Repository\RespondentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Index extends Component
{
    public Collection $respondentDatas;

    public function __construct(
        protected RespondentRepository $respondentRepository = new RespondentRepository()
    ) {
    }

    public function mount(): void
    {
        $this->respondentDatas =  $this->respondentRepository->getRespondents();
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

        return Excel::download(new RespondentExport, "Respondent_$currentDate.xlsx");
    }

    #[Title('Respondent')]
    public function render(): View
    {
        return view('livewire.admin.respondent.index');
    }
}
