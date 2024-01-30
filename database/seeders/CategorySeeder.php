<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::Create(['name'=>'Terror']);
        Category::Create(['name'=>'Comedia']);
        Category::Create(['name'=>'Cocina']);
    }
}
