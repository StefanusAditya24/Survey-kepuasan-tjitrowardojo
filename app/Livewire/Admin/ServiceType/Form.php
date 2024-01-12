<?php

namespace App\Livewire\Admin\ServiceType;

use App\Models\ServiceType;
use App\Repository\ServiceTypeRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Form extends Component
{
    public $serviceTypeModel;
    public string $name = "";

    public function __construct(
        protected ServiceTypeRepository $serviceTypeRepository = new ServiceTypeRepository(),

    ) {
    }

    public function mount(mixed $serviceTypeId = null): void
    {
        $this->serviceTypeModel = new ServiceType();
        if (!is_null($serviceTypeId)) {
            $this->serviceTypeModel = $this->serviceTypeRepository->getServiceType($serviceTypeId);
            $this->name = $this->serviceTypeModel->name;
        }
    }

    public function save(): mixed
    {
        $model = $this->serviceTypeModel;
        $model->name = $this->name;
        $model->save();
        return redirect(route('service-type.index'))->with('status', "Berhasil");
    }

    #[Title('Jenis Pelayanan Form')]
    public function render(): View
    {
        return view('livewire.admin.service-type.form');
    }
}
