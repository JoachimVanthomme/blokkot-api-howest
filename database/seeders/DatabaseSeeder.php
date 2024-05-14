<?php

namespace Database\Seeders;

use App\Models\Favourite;
use App\Models\Location;
use App\Models\Locations_language;
use App\Models\Owner;
use App\Models\User;
use Database\Factories\Locations_languageFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('hash1234'),
            'is_admin' => false,
            'is_developer' => true,
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
            if (!Owner::where('location_id', $owner->location_id)
                    ->exists() && Owner::where($owner->is_admin === true)) {
                $owner->save();
            }
        }

        Locations_language::factory()->create([
            'location_id' => 1,
            'language' => 'en',
            'hours' => 'Opening hours in english',
            'info' => 'Info in english',
        ]);

        Locations_language::factory()->create([
            'location_id' => 1,
            'language' => 'nl',
            'hours' => 'Openingsuren in het nederlands',
            'info' => 'Informatie in het nederlands',
        ]);
    }
}
