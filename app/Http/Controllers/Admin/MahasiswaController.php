<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\DosenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    protected $users;
    protected DosenService $dosenService;

    public function __construct(DosenService $dosenService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->dosenService = $dosenService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dosenService->index($request);
        }
        return view('admin.mahasiswa', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'dosen',
        ));
    }
}
