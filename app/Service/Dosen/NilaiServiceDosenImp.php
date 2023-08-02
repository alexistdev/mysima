<?php

namespace App\Service\Dosen;

use App\Http\Requests\Dosen\InputNilaiRequest;
use App\Models\usermatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NilaiServiceDosenImp implements NilaiServiceDosen
{
    public function index(Request $request):Collection
    {
        $dataAll = usermatkul::with('matkul','maha')->where('matakuliah_id',base64_decode(urldecode($request->mapel)))->get();
        $filter = $dataAll->where('maha.mahasiswa.kelas_id',base64_decode(urldecode($request->kelas)));
        return $filter->where(function ($item){
            return $item->maha->role_id  == "3";
        });
    }

    public function save(InputNilaiRequest $request): void
    {
        $total = ((int) $request->nilai_uts * 0.3) + ((int) $request->nilai_uas * 0.3) + ((int) $request->nilai_presensi * 0.1) + 30;
        usermatkul::where('id', base64_decode($request->usermatkul_id))->update([
            'uts' => $request->nilai_uts,
            'uas' => $request->nilai_uas,
            'presensi' => $request->nilai_presensi,
            'total' => $total
        ]);
    }


}
