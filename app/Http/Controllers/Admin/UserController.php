<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MahasiswaRequest;
use App\Http\Requests\Admin\SKSRequest;
use App\Models\MataKuliah;
use App\Models\User;
use App\Models\usermatkul;
use Exception;
use App\Service\Admin\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $userId = $request->user_id;
            $dataMatkul = MataKuliah::whereDoesntHave('users', function($query) use ($userId){
                $query->where('user_id',$userId);
            })->get();
            return DataTables::of($dataMatkul)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
//                    $url = route('adm.mahasiswa.edit', $row->id);
//                    $detail = route('adm.mahasiswa.detail', base64_encode($row->id));
//                    $btn = "<a href=\"$detail\"><button class=\"btn btn-sm btn-primary m-1\" > View</button></a>";
//                    $btn = $btn."<a href=\"$url\"><button class=\"btn btn-sm btn-success m-1\" > Edit</button></a>";
                    $btn = "<button class=\"btn btn-sm btn-success m-1 open-matkul\" data-id=\"$row->id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalAdd\"> <i class=\"fa fa-plus\"></i></button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
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
}
