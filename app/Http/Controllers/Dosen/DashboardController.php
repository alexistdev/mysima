<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $totalSiswa = Mahasiswa::count();
        return view('dosen.dashboard', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'dashboard',
            'menuKedua' => 'dashboard',
            'totalSiswa' => $totalSiswa

        ));
    }
}
