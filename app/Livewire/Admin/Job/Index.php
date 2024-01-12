<?php

namespace App\Livewire\Admin\Job;

use App\Repository\JobRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    public Collection $jobDatas;

    public function __construct(
        protected JobRepository $jobRepository = new JobRepository()
    ) {
    }

    public function mount(): void
    {
        $this->jobDatas =  $this->jobRepository->getJobs();
    }

    public function delete(mixed $jobId): mixed
    {
        $job = $this->jobRepository->getJob($jobId);
        $job->delete();
        return redirect(route('job.index'))->with('status', "Berhasil");
    }

    #[Title('Pekerjaan')]
    public function render(): View
    {
        return view('livewire.admin.job.index');
    }
}
