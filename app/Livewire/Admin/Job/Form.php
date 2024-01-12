<?php

namespace App\Livewire\Admin\Job;

use App\Models\Job;
use App\Repository\JobRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Form extends Component
{
    public $jobModel;
    public string $name = "";

    public function __construct(
        protected JobRepository $jobRepository = new JobRepository(),

    ) {
    }

    public function mount(mixed $jobId = null): void
    {
        $this->jobModel = new Job();
        if (!is_null($jobId)) {
            $this->jobModel = $this->jobRepository->getJob($jobId);
            $this->name = $this->jobModel->name;
        }
    }

    public function save(): mixed
    {
        $model = $this->jobModel;
        $model->name = $this->name;
        $model->save();
        return redirect(route('job.index'))->with('status', "Berhasil");
    }

    #[Title('Job Form')]
    public function render(): View
    {
        return view('livewire.admin.job.form');
    }
}
