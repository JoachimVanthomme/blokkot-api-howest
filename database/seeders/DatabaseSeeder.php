<?php

namespace Database\Seeders;

use App\Models\Favourite;
use App\Models\Location;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'is_admin' => false,
            ]);

        Location::factory(10)->create();

        while (Favourite::count() < 25) {
            $favourite = Favourite::factory()->make();
            if (!Favourite::where('user_id', $favourite->user_id)->where('location_id', $favourite->location_id)->exists()) {
                $favourite->save();
            }
        }

        while (Owner::count() < 5) {
            $owner = Owner::factory()->make();
            if (!Owner::where('user_id', $owner->user_id)
                    ->where('location_id', $owner->location_id)
                    ->exists() && Owner::where($owner->is_admin === true)) {
                $owner->save();
            }
        }
    }
}
