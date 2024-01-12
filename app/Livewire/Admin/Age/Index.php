<?php

namespace App\Livewire\Admin\Age;

use App\Repository\AgeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    public Collection $ageDatas;

    public function __construct(
        protected AgeRepository $ageRepository = new AgeRepository()
    ) {
    }

    public function mount(): void
    {
        $this->ageDatas =  $this->ageRepository->getAges();
    }

    public function delete(mixed $ageId): mixed
    {
        $age = $this->ageRepository->getAge($ageId);
        $age->delete();
        return redirect(route('age.index'))->with('status', "Berhasil");
    }

    #[Title('Umur')]
    public function render(): View
    {
        return view('livewire.admin.age.index');
    }
}
