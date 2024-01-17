<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Question\Type;

use App\Repository\QuestionTypeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class TypeIndex extends Component
{
    public Collection $questionTypes;

    public function __construct(
        protected QuestionTypeRepository $questionTypeRepository = new QuestionTypeRepository()
    ) {
    }

    public function mount(): void
    {
        $this->questionTypes =  $this->questionTypeRepository->getQuestionTypes();
    }

    /**
     * @param mixed $questionTypeId
     * @return RedirectResponse|Application|Redirector|\Illuminate\Foundation\Application
     */
    public function delete(mixed $questionTypeId): RedirectResponse|Application|Redirector|\Illuminate\Foundation\Application
    {
        $question = $this->questionTypeRepository->getQuestionType($questionTypeId);
        $question->delete();
        return redirect(route('type.index'))->with('status', "Berhasil");
    }

    #[Title('Jenis Pertanyaan')]
    public function render(): View
    {
        return view('livewire.admin.type.index');
    }
}