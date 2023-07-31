<?php

namespace App\Service\Dosen;

use App\Models\Mahasiswa;
use App\Models\usermatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NilaiServiceDosenImp implements NilaiServiceDosen
{
    public function index(Request $request):Collection
    {
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
        return $filter->where(function ($item){
            return $item->maha->role_id  == "3";
        });
    }
}
