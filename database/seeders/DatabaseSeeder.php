<?php

namespace Database\Seeders;

use App\Models\RayonKamar;
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

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'role' => 'pusat',
        ]);
        $rayon_kamar = ["As-Syafi'ie", 'Al-Ghazali', 'Al-Bukhari', "Al-Asy'ari", 'Dalfis', 'EAL', 'Tahfidh', 'Salaf', 'Lokal Santri Baru'];
        foreach ($rayon_kamar as $rayon) {
            RayonKamar::create([
                'nama' => $rayon,
            ]);
        }
    }
}
