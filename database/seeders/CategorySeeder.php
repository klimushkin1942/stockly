<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'parent' => 'Одежда',
                'children' => ['Мужская Одежда', 'Женская Одежда', 'Детская Одежда']
            ],
            [
                'parent' => 'Электроника',
                'children' => ['Бытовая техника', 'Смартфоны', 'Ноутбуки']
            ]
        ];

        foreach ($categories as $category) {
            $parentCategory = Category::firstOrCreate(['title' => $category['parent']]);

            foreach ($category['children'] as $child) {
                $childCategory = Category::firstOrCreate(['title' => $child]);
                $childCategory->parent_id = $parentCategory->id;
                $childCategory->save();
            }
        }
    }
}
