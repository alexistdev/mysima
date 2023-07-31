<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KelasRequest;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Exception;
use App\Service\Admin\KelasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    protected $users;
    protected KelasService $kelasService;

    public function __construct(KelasService $kelasService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->kelasService = $kelasService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->kelasService->index($request);
        }
        return view('admin.kelas', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'kelas',
        ));
    }

    public function store(KelasRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->kelasService->save($request);
            DB::commit();
            return redirect(route('adm.kelas'))->with(['success' => "Data Kelas Berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.kelas'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function detail($id){
        $idKelas = base64_decode($id);
       $kelas = Kelas::findOrFail($idKelas);
       $dataMahasiswa = Mahasiswa::where('kelas_id',$kelas->id)->get();
        return view('admin.detailkelas', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'kelas',
            'dataKelas'  => $kelas,
            'jmlMahasiswa' => $dataMahasiswa->count()
        ));
    }


    public function getDataMahasiswa(Request $request){
        if ($request->ajax()) {
            return $this->kelasService->get_data_mahasiswa_kelas($request);
        }
        return null;
    }

    public function getDataMahasiswaNonKelas(Request $request){
        if ($request->ajax()) {
            return $this->kelasService->get_data_mahasiswa_non_kelas($request);
        }
        return null;
    }

}
