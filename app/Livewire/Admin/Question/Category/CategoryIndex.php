<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Question\Category;

use App\Repository\CategoryRepository;
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
class CategoryIndex extends Component
{
    public Collection $categories;

    public function __construct(
        protected CategoryRepository $categoryRepository = new CategoryRepository()
    ) {
    }

    public function mount(): void
    {
        $this->categories =  $this->categoryRepository->getCategories();
    }

    /**
     * @param mixed $categoryId
     * @return RedirectResponse|Application|Redirector|\Illuminate\Foundation\Application
     */
    public function delete(mixed $categoryId): RedirectResponse|Application|Redirector|\Illuminate\Foundation\Application
    {
        $question = $this->categoryRepository->getCategory($categoryId);
        $question->delete();
        return redirect(route('type.index'))->with('status', "Berhasil");
    }

    #[Title('Kategori')]
    public function render(): View
    {
        return view('livewire.admin.category.index');
    }
}