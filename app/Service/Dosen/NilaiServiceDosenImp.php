<?php

namespace App\Service\Dosen;

use App\Http\Requests\Dosen\InputNilaiRequest;
use App\Models\usermatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NilaiServiceDosenImp implements NilaiServiceDosen
{
    public function index(Request $request): Collection
    {
        $dataAll = usermatkul::with('matkul', 'maha')->where('matakuliah_id', base64_decode(urldecode($request->mapel)))->get();
        $filter = $dataAll->where('maha.mahasiswa.kelas_id', base64_decode(urldecode($request->kelas)));
//        return $filter->where(function ($item){
//            return $item->maha->role_id  == "3";
//        });
        return $filter;
    }

    public function save(InputNilaiRequest $request): void
    {
        $total = ((int)$request->nilai_uts * 0.3) + ((int)$request->nilai_uas * 0.3) + ((int)$request->nilai_presensi * 0.1) + 30;

        usermatkul::where('id', base64_decode($request->usermatkul_id))->update([
            'uts' => $request->nilai_uts,
            'uas' => $request->nilai_uas,
            'presensi' => $request->nilai_presensi,
            'total' => $total,
        ]);
        $dataUser = usermatkul::where('id', base64_decode($request->usermatkul_id))->first();
        $uts = $dataUser->uts;
        $uas = $dataUser->uas;
        $presensi = $dataUser->presensi;
        $nilai = $this->cekNilai($total, $uts, $uas, $presensi);
        usermatkul::where('id', base64_decode($request->usermatkul_id))->update([
            'nilai' => $nilai,
            'islulus' => $this->isLulus($nilai)
        ]);
    }

    private function isLulus(string $nilai):int
    {
        $isLulus = 0;
        if(in_array($nilai,["A","B","C"])){
            $isLulus = 1;
        }
        return $isLulus;
    }

    private function cekNilai($total, $uts, $uas, $presensi): string
    {
        $str = "E";
        if ($total > 79) {
            if($this->isValid($uts, $uas, $presensi)){
                $str = "A";
            }
        } else if ($total > 69 && $total <= 79) {
            if($this->isValid($uts, $uas, $presensi)) {
                $str = "B";
            }
        } else if ($total > 69 && $total <= 79) {
            if($this->isValid($uts, $uas, $presensi)){
                $str = "C";
            }
        } else if ($total > 59 && $total <= 69) {
            if($this->isValid($uts, $uas, $presensi)) {
                $str = "D";
            }
        } else {
            return $str;
        }
        return $str;
    }

    private function isValid($uts, $uas, $presensi): bool
    {
        if ($uts != 0 && $uas != 0 && $presensi) {
            return true;
        }
        return false;
    }


}
