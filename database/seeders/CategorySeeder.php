<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('category_profile')->truncate();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        $categories = [
            'Video Editor',
            'Foto Editor',
            'Graphic Designer',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
