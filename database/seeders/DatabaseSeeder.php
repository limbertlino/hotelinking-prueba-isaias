<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Offer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(4)->create();
        $offers = Offer::factory(8)->create();

        // Code::factory(10)->create([
        //     'user_id' => fn() => $users->random()->id,
        //     'offer_id' => fn() => $offers->random()->id,
        // ]);

        Code::factory(4)
            ->recycle([$users, $offers])
            ->create([
                'user_id' => fn() => $users->random()->id,
                'offer_id' => fn() => $offers->random()->id,
            ]);

    }
}
