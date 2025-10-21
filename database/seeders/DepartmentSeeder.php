<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Electronics', 'slug' => Str::slug('Electronics'), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Clothing', 'slug' => Str::slug('Clothing'), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Home & Kitchen', 'slug' => Str::slug('Home & Kitchen'), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Books', 'slug' => Str::slug('Books'), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports & Outdoors', 'slug' => Str::slug('Sports & Outdoors'), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('departments')->insert($departments);
    }
}
