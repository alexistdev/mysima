<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dosen\InputNilaiRequest;
use App\Models\Kelas;
use Exception;
use App\Models\usermatkul;
use App\Service\Dosen\NilaiServiceDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputNilaiController extends Controller
{
    protected $users;
    protected NilaiServiceDosen $nilaiServiceDosen;


    public function __construct(NilaiServiceDosen $nilaiServiceDosen)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->nilaiServiceDosen = $nilaiServiceDosen;
    }

    public function index(Request $request)
    {
        $data = collect();
        if($request->get('mapel') && $request->get('kelas')){
            $data = $this->nilaiServiceDosen->index($request);
        }
        return view('dosen.nilai', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'inputNilai',
            'menuKedua' => 'inputNilai',
            'dataMatakuliah' => usermatkul::with('matkul')->where('user_id',$this->users->id)->get(),
            'dataKelas' => Kelas::all(),
            'dataTabel' => $data,
            'opsiMapel' => urldecode($request->get('mapel')) ?? '',
            'opsiKelas' => urldecode($request->get('kelas')) ?? '',
        ));
    }

    public function store(InputNilaiRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->nilaiServiceDosen->save($request);
            DB::commit();
            return redirect(route('dosen.nilai').'?mapel='.urlencode($request->mapel_id).'&kelas='.urlencode($request->kelas_id))->with(['success' => "Data Kelas Berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('dosen.nilai'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
