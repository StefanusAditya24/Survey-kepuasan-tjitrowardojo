<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Question\Category;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class CategoryForm extends Component
{
    public Category $category;

    public string $category_name = "";

    public function __construct(
        protected CategoryRepository $categoryRepository = new CategoryRepository(),

    ) {
    }

    public function mount(mixed $categoryId = null): void
    {
        $this->category = new Category();
        if (!is_null($categoryId)) {
            $this->category = $this->categoryRepository->getCategory($categoryId);
            $this->category_name = $this->category->category_name;
        }
    }

    public function save(): mixed
    {
        $this->category = new Category();
        $model = $this->category;
        $model->category_name = $this->category_name;
        $model->save();
        return redirect(route('category.index'))->with('status', "Berhasil");
    }

    #[Title('Category Form')]
    public function render(): View
    {
        return view('livewire.admin.category.form');
    }
}