<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'Vue'],
            ['name' => 'React'],
            ['name' => 'Angular'],
            ['name' => 'JavaScript'],
            ['name' => 'CSS'],
            ['name' => 'HTML'],
            ['name' => 'Bootstrap'],
            ['name' => 'Tailwind'],
            ['name' => 'Node.Js']
        ]);
    }
}
