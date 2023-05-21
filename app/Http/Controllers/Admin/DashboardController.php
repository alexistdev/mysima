<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminTrait;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AdminTrait;

    public function index()
    {
        return view('admin.dashboard', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'dashboard',
            'menuKedua' => 'dashboard',
        ));
    }
}
