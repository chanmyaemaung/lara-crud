<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 25; $i++) {
            DB::table('posts')->insert([
                'title' => Str::random(15),
                'description' => Str::random(50),
                'category_id' => rand(1, 11),
                'image' => 'https://picsum.photos/200/300',
                'status' => '1',
            ]);
        }
    }
}
