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
            array('user_id' => '3', 'kelas_id' => '1','nim' => '1911010022', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
            array('user_id' => '4', 'kelas_id' => '1','nim' => '1911010007', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
            array('user_id' => '5', 'kelas_id' => '1','nim' => '1911010090', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
            array('user_id' => '6', 'kelas_id' => '1','nim' => '1911010036', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
            array('user_id' => '7', 'kelas_id' => '1','nim' => '1911010030', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
            array('user_id' => '8', 'kelas_id' => '1','nim' => '1911010012', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
            array('user_id' => '9', 'kelas_id' => '1','nim' => '1911010035', 'phone' => '-', 'alamat' => '-', 'created_at' => $date, 'updated_at' => $date),
        ];
        Mahasiswa::insert($mahasiswa);
    }
}
