<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Mobile Phones', 'parent_id' => null, 'department_id' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laptops', 'parent_id' => 1, 'department_id' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Men\'s Clothing', 'parent_id' => null, 'department_id' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Women\'s Clothing', 'parent_id' => null, 'department_id' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kitchen Appliances', 'parent_id' => null, 'department_id' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Furniture', 'parent_id' => null, 'department_id' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fiction', 'parent_id' => null, 'department_id' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Non-Fiction', 'parent_id' => null, 'department_id' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Outdoor Gear', 'parent_id' => null, 'department_id' => 5, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Non-Fiction', 'parent_id' => null, 'department_id' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Outdoor Gear', 'parent_id' => null, 'department_id' => 5, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],

        ];

        DB::table('categories')->insert($categories);
    }
}
