<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MahasiswaRequest;
use App\Http\Requests\Admin\SKSRequest;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use App\Models\usermatkul;
use Exception;
use App\Service\Admin\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder;
use Yajra\DataTables\DataTables;

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

    public function detail($id)
    {
        $user = User::with('mahasiswa')->where('role_id', '3')->findOrFail(base64_decode($id));
        return view('admin.detailmahasiswa', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'mahasiswa',
            'dataMahasiswa' => $user,
            'idUser' => $id,
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

    public function getDataMatkul(Request $request)
    {
        if ($request->ajax()) {
            return $this->mahasiswaService->dataMatkul($request);
        }
       return null;
    }

    public function matkul_add($id,SKSRequest $request)
    {
        $request->validated();
        $user = User::with('mahasiswa')->where('role_id', '3')->findOrFail(base64_decode($id));
        DB::beginTransaction();
        try {
            $this->mahasiswaService->addSKS($request,$user);
            DB::commit();
            return redirect(route('adm.mahasiswa.detail', $id))->with(['success' => "SKS berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.mahasiswa'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getDataSKS(Request $request)
    {
        if ($request->ajax()) {
            return $this->mahasiswaService->dataSKS($request);
        }
        return null;
    }

    public function isbayar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id'     => 'required|numeric',
            'status'     => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $mahasiswa = Mahasiswa::where('id',$request->mahasiswa_id)->update([
            'isBayar' => $request->status,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request->status
        ]);

    }
}
