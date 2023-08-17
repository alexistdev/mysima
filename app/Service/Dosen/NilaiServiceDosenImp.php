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

        $dataUser = usermatkul::where('id', base64_decode($request->usermatkul_id))->update([
            'uts' => $request->nilai_uts,
            'uas' => $request->nilai_uas,
            'presensi' => $request->nilai_presensi,
            'total' => $total,
        ]);
        $uts = $dataUser->uts;
        $uas = $dataUser->uas;
        $presensi = $dataUser->presensi;
        $nilai = $this->cekNilai($total, $uts, $uas, $presensi);
        usermatkul::where('id', base64_decode($request->usermatkul_id))->update([
            'nilai' => $nilai
        ]);
    }

    private function cekNilai($total, $uts, $uas, $presensi): string
    {
        $str = "E";
        if ($total > 79) {
            if ($uts != 0 && $uas != 0 && $presensi) {
                $str = "A";
            }
        } else if ($total > 69 && $total <= 79) {
            if ($uts != 0 && $uas != 0 && $presensi) {
                $str = "B";
            }
        } else if ($total > 69 && $total <= 79) {
            if ($uts != 0 && $uas != 0 && $presensi) {
                $str = "C";
            }
        } else if ($total > 59 && $total <= 69) {
            if ($uts != 0 && $uas != 0 && $presensi) {
                $str = "D";
            }
        } else {
            return $str;
        }
        return $str;
    }


}
