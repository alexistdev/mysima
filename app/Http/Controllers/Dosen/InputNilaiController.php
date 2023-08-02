<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\usermatkul;
use App\Service\Dosen\NilaiServiceDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//        return $data;
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
}
