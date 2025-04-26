<?php

namespace Database\Seeders;

use App\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productGroups = [
            'Верхняя одежда',
            'Джинсы и брюки',
            'Рубашки и футболки',
            'Нижнее бельё',
            'Платья и юбки',
            'Блузки и топы',
            'Одежда для новорождённых',
            'Школьная форма',
            'Кухонная техника',
            'Уборка',
            'Климат',
            'Стирка',
            'По брендам',
            'Аксессуары',
            'Умные часы'
        ];

        foreach ($productGroups as $productGroup) {
            ProductGroup::firstOrCreate(['title' => $productGroup]);
        }
    }
}
