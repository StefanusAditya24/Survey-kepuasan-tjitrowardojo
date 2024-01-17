<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Question\Type;

use App\Models\QuestionType;
use App\Repository\QuestionTypeRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class TypeForm extends Component
{
    public QuestionType $questionType;

    public string $type = "";

    public function __construct(
        protected QuestionTypeRepository $questionTypeRepository = new QuestionTypeRepository(),

    ) {
    }

    public function mount(mixed $typeId = null): void
    {
        $this->questionType = new QuestionType();
        if (!is_null($typeId)) {
            $this->questionType = $this->questionTypeRepository->getQuestionType($typeId);
            $this->type = $this->questionType->type;
        }
    }

    public function save(): mixed
    {
        $this->questionType = new QuestionType();
        $model = $this->questionType;
        $model->type = $this->type;
        $model->save();
        return redirect(route('category.index'))->with('status', "Berhasil");
    }

    #[Title('Question Type Form')]
    public function render(): View
    {
        return view('livewire.admin.type.form');
    }
}