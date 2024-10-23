<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class LoginLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //
        DB::table('login_logs')->insert([
            'user_id' => $faker -> numberBetween(1, 1),
            'ip_address' => $faker -> ipv4,
            'user_agent' => $faker -> userAgent(),
            'login_at' => $faker -> dateTimeBetween('-1 month', '+3 days'),
            'created_at' => $faker -> dateTimeBetween('-1 month', '+3 days'),
            'updated_at' => $faker -> dateTimeBetween('-1 month', '+3 days'),
        ]);
    }
}
