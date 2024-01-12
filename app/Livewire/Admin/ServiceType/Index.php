<?php

namespace App\Livewire\Admin\ServiceType;

use App\Repository\ServiceTypeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    public Collection $serviceTypeDatas;

    public function __construct(
        protected ServiceTypeRepository $serviceTypeRepository = new ServiceTypeRepository()
    ) {
    }

    public function mount(): void
    {
        $this->serviceTypeDatas =  $this->serviceTypeRepository->getServiceTypes();
    }

    public function delete(mixed $serviceTypeId): mixed
    {
        $serviceType = $this->serviceTypeRepository->getServiceType($serviceTypeId);
        $serviceType->delete();
        return redirect(route('service-type.index'))->with('status', "Berhasil");
    }

    #[Title('Jenis Pelayanan')]
    public function render(): View
    {
        return view('livewire.admin.service-type.index');
    }
}
