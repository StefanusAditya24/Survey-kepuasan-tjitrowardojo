<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class CategoryRepository
{
    public function __construct(
        protected Category $model = new Category()
    ) {
    }

    public function getCategory(mixed $questionId): ?Category
    {
        return $this->model->findOrFail($questionId);
    }

    public function getCategories(): Collection
    {
        return $this->model->all();
    }
}