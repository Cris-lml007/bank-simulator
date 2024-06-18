<?php

namespace Database\Seeders;

use App\Models\Account;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $a = new User([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '12345678'
        ]);
        $a->save();

        $a1 = new Account([
            'user_id' => $a->id
        ]);

        $a1->save();

        $b = new User([
            'name' => 'client',
            'email' => 'client@example.com',
            'password' => '12345678'
        ]);
        $b->save();

        $b1 = new Account([
            'user_id' => $b->id
        ]);

        $b1->balance = 1200;
        $b1->save();

    }
}
