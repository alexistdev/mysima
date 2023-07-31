<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\usermatkul;
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
        $data = collect();
        if($request->get('mapel') && $request->get('kelas')){
            $mahasiswa = Mahasiswa::where('kelas_id',base64_decode(urldecode($request->kelas)))->get();
            $dataAll = usermatkul::with('matkul','maha')->where('matakuliah_id',base64_decode(urldecode($request->mapel)))->get();
            $filter = $dataAll->filter(function ($item) use ($mahasiswa){
                foreach($mahasiswa as $row){
                    if($item['user_id'] !== $row->user_id){
                        return false;
                    }
                }
                return true;
            });
            $data = $filter->where(function ($item){
                return $item->maha->role_id  == "3";
            });
        }
//        return $data;
        $kelas = Kelas::all();
        $matakuliah = usermatkul::with('matkul')->where('user_id',$this->users->id)->get();
        return view('dosen.nilai', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'inputNilai',
            'menuKedua' => 'inputNilai',
            'dataMatakuliah' => $matakuliah,
            'dataKelas' => $kelas,
            'dataTabel' => $data,
            'opsiMapel' => urldecode($request->get('mapel')) ?? '',
            'opsiKelas' => urldecode($request->get('kelas')) ?? '',
        ));
    }
}
