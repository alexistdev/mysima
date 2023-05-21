<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $role = [
            array('name' => 'admin','created_at' => $date,'updated_at' => $date),
            array('name' => 'user','created_at' => $date,'updated_at' => $date),
        ];
        Role::insert($role);
    }
}
