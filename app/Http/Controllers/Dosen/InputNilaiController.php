<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Service\Admin\MapelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputNilaiController extends Controller
{
    protected $users;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        return view('dosen.nilai', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'inputNilai',
            'menuKedua' => 'inputNilai',
        ));
    }
}
