<?php

namespace App\Livewire\Admin\Education;

use App\Repository\EducationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    public Collection $educationDatas;

    public function __construct(
        protected EducationRepository $educationRepository = new EducationRepository()
    ) {
    }

    public function mount(): void
    {
        $this->educationDatas =  $this->educationRepository->getEducations();
    }

    public function delete(mixed $educationId): mixed
    {
        $education = $this->educationRepository->getEducation($educationId);
        $education->delete();
        return redirect(route('education.index'))->with('status', "Berhasil");
    }

    #[Title('Pendidikan')]
    public function render(): View
    {
        return view('livewire.admin.education.index');
    }
}
