<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        DB::table('articles')->insert([
            'slug' => $faker -> slug(),
            'title' => $faker -> sentences(3, true),
            'types_id' => $faker -> numberBetween(2,5), 
            'users_id' => $faker -> numberBetween(1,1),
            'keywords' => $faker -> sentence(5, true),
            'description' => $faker -> sentence(5, true),
            'content' => $faker -> text(200),
            'author' => $faker -> userName(),
            'source' => $faker -> url(),
            'cover' =>$faker -> imageUrl(),
            'status' => $faker -> numberBetween(1, 1),
            'views' => $faker -> randomNumber(5),
            'likes' => $faker -> randomNumber(5),
            'created_at' => $faker -> dateTimeBetween('-1 month', '+3 days'),
            'updated_at' => $faker -> dateTimeBetween('-1 month', '+3 days'),
        ]);
    }
}
