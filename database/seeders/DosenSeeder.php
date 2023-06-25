<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $dosen = [
            array('user_id' => '2','nik' => '12345','phone' => '0812345678','alamat'=>'lampung','created_at' => $date,'updated_at' => $date)
            ];
        Dosen::insert($dosen);
    }
}
