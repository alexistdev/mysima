<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $kelas = [
            array('id' => '1', 'name' => 'P1 A', 'isActive' => '1','created_at' => $date, 'updated_at' => $date),
        ];
        Kelas::insert($kelas);
    }
}
