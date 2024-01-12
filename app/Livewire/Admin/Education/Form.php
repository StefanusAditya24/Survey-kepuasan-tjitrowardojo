<?php

namespace App\Livewire\Admin\Education;

use App\Models\Education;
use App\Repository\EducationRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Form extends Component
{
    public $educationModel;
    public string $name = "";

    public function __construct(
        protected EducationRepository $educationRepository = new EducationRepository(),

    ) {
    }

    public function mount(mixed $educationId = null): void
    {
        $this->educationModel = new Education();
        if (!is_null($educationId)) {
            $this->educationModel = $this->educationRepository->getEducation($educationId);
            $this->name = $this->educationModel->name;
        }
    }

    public function save(): mixed
    {
        $model = $this->educationModel;
        $model->name = $this->name;
        $model->save();
        return redirect(route('education.index'))->with('status', "Berhasil");
    }

    #[Title('Education Form')]
    public function render(): View
    {
        return view('livewire.admin.education.form');
    }
}
