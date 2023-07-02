<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MahasiswaRequest;
use App\Models\User;
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
            return redirect(route('adm.mahasiswa'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $user = User::with('mahasiswa')->findOrFail($id);
        if($user->mahasiswa != null){
            return view('admin.editmahasiswa', array(
                'judul' => "Dashboard Administrator | MySima",
                'menuUtama' => 'master',
                'menuKedua' => 'mahasiswa',
                'dataMahasiswa' => $user,
            ));
        }
        abort('404', 'NOT FOUND');
    }

    public function update(MahasiswaRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->mahasiswaService->update($request);
            DB::commit();
            return redirect(route('adm.mahasiswa.edit', $request->user_id))->with(['hapus' => "Data Mahasiswa Berhasil diperbaharui!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.mahasiswa'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
