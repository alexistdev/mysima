<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminTrait;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AdminTrait;

    public function index()
    {
        $user= User::with('mahasiswa')->where('role_id',"3")
            ->orderBy('id','DESC')
            ->take(5)
            ->get();
        return view('admin.dashboard', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'dashboard',
            'menuKedua' => 'dashboard',
            'dataMahasiswa' => $user,

        ));
    }
}
