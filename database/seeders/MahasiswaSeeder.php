<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $mahasiswa = [
            array('user_id' => '3', 'kelas_id' => '1','nim' => '2221210003', 'phone' => '0812345678', 'alamat' => 'lampung', 'created_at' => $date, 'updated_at' => $date)
        ];
        Mahasiswa::insert($mahasiswa);
    }
}
