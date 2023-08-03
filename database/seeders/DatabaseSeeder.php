<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CriteriaSeeder::class,
            DosenSeeder::class,
            KelasSeeder::class,
            MahasiswaSeeder::class,
            MataKuliahSeeder::class,
        ]);
    }
}
