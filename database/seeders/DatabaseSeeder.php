<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Articles;
use App\Models\LoginLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    use WithoutModelEvents;
    public function run(): void
    {
        /*
        //User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        */

        
        //call 单个 ArticleSeeder
        /* $this->call([
            ArticleSeeder::class,
            //LoginLogSeeder::class,
        ]); */

        Articles::factory()
            ->count(50)
            ->create();

        /* LoginLog::factory()
            ->count(50)
            ->create(); */
    }
}
