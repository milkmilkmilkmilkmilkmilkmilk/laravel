<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        \App\Models\Article::factory(10)->has(Comment::factory(3))->create();
      
    }
}