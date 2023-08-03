<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $matkul = [
            array('code' => 'IBI19201', 'name' => 'Agama','sks' => '2', 'priority' => 1,'created_at' => $date, 'updated_at' => $date),//1
            array('code' => 'TIF19203', 'name' => 'Logika Informatika','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//2
            array('code' => 'TIF19401', 'name' => 'Pemrograman Dasar','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//3
            array('code' => 'TIF19404', 'name' => 'Matematika Diskrit','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//4
            array('code' => 'TIF19406', 'name' => 'Database Technology','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//5
            array('code' => 'IBI19203', 'name' => 'Bahasa Inggris 1','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//6
            array('code' => 'IBI19213', 'name' => 'Kajian Agama','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//7
            array('code' => 'IBI20208', 'name' => 'Kewirausahaan','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//8
            array('code' => 'TIF19202', 'name' => 'Pengantar Ilmu Komputer','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//9
            array('code' => 'TIF19202', 'name' => 'Statistika Dan Probabilitas','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//10
            array('code' => 'TIF19407', 'name' => 'Pemrograman Menengah','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//11
            array('code' => 'IBI19214', 'name' => 'Bahasa Inggris 2','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//12
            array('code' => 'IBI20217', 'name' => 'Technopreneur','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//13
            array('code' => 'SKO20408', 'name' => 'Organisasi Dan Arsitektur Komputer','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//14
            array('code' => 'TIF20208', 'name' => 'Analisis Struktur Data','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//15
            array('code' => 'TIF20209', 'name' => 'Mobile Computing','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//16
            array('code' => 'TIF20211', 'name' => 'Aljabar Linear','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//17
            array('code' => 'TIF20212', 'name' => 'Kecerdasan Buatan','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//18
            array('code' => 'TIF20213', 'name' => 'Multimedia','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//19
            array('code' => 'IBI20202', 'name' => 'Kajian Agama','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//20
            array('code' => 'TIF19414', 'name' => 'Komunikasi Data Dan Jaringan','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//21
            array('code' => 'TIF20215X', 'name' => 'Interaksi Manusia Dan Komputer','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//22
            array('code' => 'TIF20417', 'name' => 'Sistem Operasi','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//23
            array('code' => 'TIF20422', 'name' => 'Kemanan Komputer Dan Jaringan','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//24
            array('code' => 'TIF20448', 'name' => 'Desain Grafis Digital','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//25
            array('code' => 'TIF20449', 'name' => 'Kalkulus','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//26
            array('code' => 'TIF20410', 'name' => 'Pemrograman Lanjut','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//27
            array('code' => 'TIF20421', 'name' => 'Rekayasa Perangkat Lunak','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//28
            array('code' => 'TIF20450', 'name' => '3D Modelling And Animation','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//29
            array('code' => 'TIF20450', 'name' => 'Game Design And Programming','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//30
            array('code' => 'TIF20452', 'name' => 'Visualisasi Data Dan Informasi','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//31
            array('code' => 'IBI19205', 'name' => 'Pancasila','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//32
            array('code' => 'IBI20204', 'name' => 'Kewirausahaan','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//33
            array('code' => 'IBI20215', 'name' => 'Metodologi Penelitian Dan Penulisan Ilmiah','priority' => 1,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//34
            array('code' => 'TIF20432', 'name' => 'Proyek Perangkat Lunak','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//35
            array('code' => 'TIF20453', 'name' => 'Augmented Reality','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//36
            array('code' => 'TIF20454', 'name' => 'Interactive Multimedia','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//37
            array('code' => 'TIF20455', 'name' => 'Multimedia System','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//38
            array('code' => 'FIK20202', 'name' => 'Kekayaan Intelektual (KI)','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//39
            array('code' => 'IBI20206', 'name' => 'Pendidikan Karakter Dan Anti Korupsi','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//40
            array('code' => 'IBI20409', 'name' => 'Praktek Kerja Pengabdian Masyarakat','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//41
            array('code' => 'TIF20416', 'name' => 'Teori Bahasa Otomata Dan Kompilasi','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//42
            array('code' => 'TIF20442', 'name' => 'Penjaminan Mutu Perangkat Lunak','priority' => 1,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//43
            array('code' => 'TIF20456', 'name' => 'Multimedia Content Analysis','priority' => 0,'sks' => '4', 'created_at' => $date, 'updated_at' => $date),//44
            array('code' => 'IBI20211', 'name' => 'Pengembangan Bisnis','priority' => 0,'sks' => '2', 'created_at' => $date, 'updated_at' => $date),//45

        ];
        MataKuliah::insert($matkul);
    }
}
