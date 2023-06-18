<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $role = [
            array('premis' => 'K1','criteria' => 'Jumlah SKS lebih dari 124','created_at' => $date,'updated_at' => $date),
            array('premis' => 'K2','criteria' => 'Lulus KP atau PKPM','created_at' => $date,'updated_at' => $date),
            array('premis' => 'K3','criteria' => 'Lunas Administrasi','created_at' => $date,'updated_at' => $date),
            array('premis' => 'K4','criteria' => 'Status Mahasiswa Aktif','created_at' => $date,'updated_at' => $date),
            array('premis' => 'K5','criteria' => 'Lulus Metodologi Penelitian','created_at' => $date,'updated_at' => $date),
        ];
        Criteria::insert($role);
    }
}
