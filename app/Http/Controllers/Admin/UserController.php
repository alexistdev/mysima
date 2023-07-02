<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MahasiswaRequest;
use Exception;
use App\Service\Admin\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $users;
    protected MahasiswaService $mahasiswaService;

    public function __construct(MahasiswaService $mahasiswaService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->mahasiswaService = $mahasiswaService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->mahasiswaService->index($request);
        }
        return view('admin.user', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'mahasiswa',
        ));
    }

    public function create()
    {
        return view('admin.addmahasiswa', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'mahasiswa',
        ));
    }

    public function store(MahasiswaRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $this->mahasiswaService->save($request);
            DB::commit();
            return redirect(route('adm.mahasiswa'))->with(['success' => "Data Mahasiswa Berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
//            return redirect(route('adm.mahasiswa'))->withErrors(['error' => $e->getMessage()]);
            echo $e->getMessage();
        }
    }
}
