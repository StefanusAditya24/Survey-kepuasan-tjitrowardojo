<?php

namespace App\Livewire\Admin\Respondent;

use App\Repository\RespondentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    #[Title('Respondent')]
    public function render(): View
    {
        return view('livewire.admin.respondent.index');
    }
}
