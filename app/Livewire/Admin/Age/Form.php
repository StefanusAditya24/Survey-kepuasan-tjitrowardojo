<?php

namespace App\Livewire\Admin\Age;

use App\Models\Age;
use App\Repository\AgeRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Form extends Component
{
    public $ageModel;
    public string $name = "";

    public function __construct(
        protected AgeRepository $ageRepository = new AgeRepository(),

    ) {
    }

    public function mount(mixed $ageId = null): void
    {
        $this->ageModel = new Age();
        if (!is_null($ageId)) {
            $this->ageModel = $this->ageRepository->getAge($ageId);
            $this->name = $this->ageModel->name;
        }
    }

    public function save(): mixed
    {
        $model = $this->ageModel;
        $model->name = $this->name;
        $model->save();
        return redirect(route('age.index'))->with('status', "Berhasil");
    }

    #[Title('Age Form')]
    public function render(): View
    {
        return view('livewire.admin.age.form');
    }
}
