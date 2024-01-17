<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            1 => 'User Satisfaction',
            2 => 'Corruption Prevention',
        ];

        foreach ($categories as $category)
            Category::create(['category_name' => $category]);
    }
}