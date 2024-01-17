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
        if (!is_null($categoryId)) {
            $this->category = new Category();
            $this->category_name = $this->category->category_name;
        }
    }

    public function save(): mixed
    {
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