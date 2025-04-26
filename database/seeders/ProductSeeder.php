<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Services\ImageService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createMenClothesProducts();
        $this->createWomenClothesProducts();
        $this->createChildClothesProducts();
        $this->createElectronicsProducts();
    }

    public function createMenClothesProducts(): void
    {
        $categoryMenClothes = Category::firstWhere('title', 'Мужская Одежда');
        $productGroupJeans = ProductGroup::firstWhere('title', 'Джинсы и брюки');

        $urlImages = [
            'https://storage.yandexcloud.net/elyts-prod/main/cb0/cb040c7b8adc930111a239821254f2a0/1696248588651ab30c09dc8.jpg',
            'https://storage.yandexcloud.net/elyts-prod/main/a75/a7570d15a0aea384a85cfec91c2537e5/1696248591651ab30ff1ecb.jpg'
        ];

        $images = [];
        foreach ($urlImages as $urlImage) {
            $images[] = $this->downloadAsUploadedFile($urlImage);
        }

        $product = Product::firstOrCreate(
            [
                'title' => 'Versace Jeans Couture',
                'article' => rand(1000, 50000),
                'count' => 5,
                'description' => "Есть мнение, что лучшие производители джинсов — бренды, которые специализируются на дениме.В исполнении Versace повседневные вещи приобретают новое звучание — обычные зауженные джинсы садятся точно по фигуре и смотрятся ультрамодно и дерзко.",
                'content' => 'Что-то должно тут быть',
                'category_id' => $categoryMenClothes->id,
                'product_group_id' => $productGroupJeans->id,
                'price' => 10000,
                'discount_price' => 8000
            ]
        );

        ImageService::storeBatch($product, $images);
    }

    public function createWomenClothesProducts(): void
    {
        $categoryWomenClothes = Category::firstWhere('title', 'Женская Одежда');
    }

    public function createChildClothesProducts(): void
    {
        $categoryWomenClothes = Category::firstWhere('title', 'Детская Одежда');
    }

    public function createElectronicsProducts(): void
    {
        $categoryWomenClothes = Category::firstWhere('title', 'Электроника');
    }

    protected function downloadAsUploadedFile(string $url): UploadedFile
    {
        $response = Http::get($url);
        $tempFile = tempnam(sys_get_temp_dir(), 'product_');
        file_put_contents($tempFile, $response->body());

        return new UploadedFile(
            $tempFile,
            basename($url),
            $response->header('Content-Type'),
            null,
            true
        );
    }
}
