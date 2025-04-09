<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('0000'),
        ]);

        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);

        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);
    }
}

