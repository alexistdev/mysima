<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\KelasRequest;
use App\Http\Requests\Admin\TambahSiswaNonKelasRequest;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KelasServiceImplementation implements KelasService
{
    public function index(Request $request)
    {
        $kelas = Kelas::orderBy('id','DESC')->get();
        return DataTables::of($kelas)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $url = route('adm.kelas.detail', base64_encode($row->id));
                $btn = "<a href='$url'><button class=\"btn btn-sm btn-primary m-1\">Detail</button></a>";
                $btn = $btn."<button class=\"btn btn-sm btn-success m-1 open-edit\" data-id=\"$row->id\" data-name=\"$row->name\"  data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"> Edit</button>";
                $btn = $btn . "<button class=\"btn btn-sm btn-danger m-1 open-hapus\" data-id=\"$row->id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"> Hapus</button>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(KelasRequest $request): void
    {
        $kelas = new Kelas();
        $kelas->name = $request->name;
        $kelas->isActive = 1;
        $kelas->save();
    }

    public function get_data_mahasiswa_kelas(Request $request): JsonResponse
    {
        $mahasiswa = Mahasiswa::with('user')->where('kelas_id',$request->kelas_id)->get();
        return DataTables::of($mahasiswa)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $idUser = base64_encode($row->id);
                $btn = "<a href='#'><button class=\"btn btn-sm btn-danger m-1 open-lepas\" data-id=\"$idUser\" data-bs-toggle=\"modal\" data-bs-target=\"#modalLepas\">X</button></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function get_data_mahasiswa_non_kelas(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $mahasiswa = Mahasiswa::with('user')->whereNull('kelas_id')->get();
        return DataTables::of($mahasiswa)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $idUser = base64_encode($row->id);
                $btn = "<a href='#'><button class=\"btn btn-sm btn-primary m-1 open-konfirm\" data-id=\"$idUser\" data-name=\"$row->name\" data-bs-toggle=\"modal\" data-bs-target=\"#modalKonfirm\">+</button></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function update_siswa(int $user_id,int $kelas_id, int $tipe): void
    {
        $idKelas = null;
        if($tipe != 2){
            $idKelas = $kelas_id;
        }
       Mahasiswa::where('id',$user_id)->update([
          'kelas_id' => $idKelas
       ]);
    }



}
