<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(
            ['slug' => 'trong-nuoc'],
            ['name' => 'Tour trong nước', 'slug' => 'trong-nuoc']
        );

        Category::firstOrCreate(
            ['slug' => 'nuoc-ngoai'],
            ['name' => 'Tour nước ngoài', 'slug' => 'nuoc-ngoai']
        );
    }
}
