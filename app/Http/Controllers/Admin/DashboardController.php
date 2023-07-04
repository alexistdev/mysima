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
        $user= User::with('mahasiswa')
            ->get();
        return view('admin.dashboard', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'dashboard',
            'menuKedua' => 'dashboard',
            'dataUser' => $user->sortByDesc('id'),

        ));
    }
}
