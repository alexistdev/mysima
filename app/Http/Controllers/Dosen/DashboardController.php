<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dosen\FilterRequest;
use App\Models\ForwardChaining;
use App\Models\Mahasiswa;
use App\Models\usermatkul;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $dataFw = ForwardChaining::with('mahasiswa')->get();
        $totalSiswa = Mahasiswa::count();
        return view('dosen.dashboard', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'dashboard',
            'menuKedua' => 'dashboard',
            'totalSiswa' => $totalSiswa,
            'dataForward' => $dataFw
        ));
    }

    public function filter(FilterRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $mahasiswa = Mahasiswa::where('isSkripsi',0)->get();
            foreach ($mahasiswa as $row){
                $userMatkul = usermatkul::with('matkul')->where('user_id',$row->user_id)->get();
                //cek yg memenuhi skripsi
                if($this->isSKS($userMatkul) && $this->isPKPM($userMatkul) && $mahasiswa->isBayar != 0 && $this->isMetopel($userMatkul)){
                    $dataSks = $this->jumlahSKS($userMatkul);
                    $this->simpan_data($mahasiswa->id,$dataSks);
                }
            }
            DB::commit();
            return redirect(route('dosen.dashboard'))->with(['success' => "Analisis Forward Chaining sudah dilakukan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('dosen.nilai'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function simpan_data($mahasiswaId,$dataSks){
        $cek = ForwardChaining::where('mahasiswa_id',$mahasiswaId)->first();
        if($cek != null){
            ForwardChaining::where('id',$cek->id)->update([
                'isSKSLulus' => 1,
                'isBayar' => 1,
                'isPkpm' => 1,
                'isMetopel'=>1,
                'jumlahsks' => $dataSks
            ]);
        }else{
            $dataArray = [
                'mahasiswa_id' => $mahasiswaId,
                'isSKSLulus' => 1,
                'isBayar' => 1,
                'isPkpm' => 1,
                'isMetopel'=>1,
                'jumlahsks' => $dataSks
            ];
            ForwardChaining::insert($dataArray);
        }
    }

    private function isMetopel($userMatkul):bool{
        if($userMatkul->where('matakuliah_id', 34)->count() != 0){
            return true;
        }
        return false;
    }

    private function isPKPM($userMatkul):bool{
        if($userMatkul->where('matakuliah_id', 43)->count() != 0){
            return true;
        }
        return false;
    }

    private function isSKS($userMatkul):bool{
        if($this->jumlahSKS($userMatkul) >= 124){
            return true;
        }
        return false;
    }

    private function jumlahSKS($userMatkul):int
    {
        $sks = 0;
        foreach($userMatkul as $row){
            $sks = $sks + $row->matkul->sks ?? 0 ;
        }
        return $sks;
    }


}
