<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MahasiswaRequest;
use App\Http\Requests\Admin\SKSRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use App\Models\usermatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class MahasiswaServiceImplementation implements MahasiswaService
{
    public function index(Request $request)
    {
        $user = User::with('mahasiswa')->where('role_id', "3")->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $url = route('adm.mahasiswa.edit', $row->id);
                $detail = route('adm.mahasiswa.detail', base64_encode($row->id));
                $btn = "<a href=\"$detail\"><button class=\"btn btn-sm btn-primary m-1\" > View</button></a>";
                $btn = $btn."<a href=\"$url\"><button class=\"btn btn-sm btn-success m-1\" > Edit</button></a>";
                $btn = $btn . "<button class=\"btn btn-sm btn-danger m-1 open-hapus\" data-id=\"$row->id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"> Hapus</button>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(MahasiswaRequest $request): void
    {
        $user = new User();
        $user->role_id = 3;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $idUser = $user->id;

        $mhs = new Mahasiswa();
        $mhs->user_id = $idUser;
        $mhs->nim = $request->nim;
        $mhs->phone = $request->phone;
        $mhs->alamat = $request->alamat;
        $mhs->save();
    }

    public function update(MahasiswaRequest $request): void
    {
        $dataArray = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if (!is_null($request->password)) {
            $dataArray['password'] = Hash::make($request->password);
        }
        User::where('id', $request->user_id)->update($dataArray);
        Mahasiswa::where('user_id', $request->user_id)->update([
            'nim'=> $request->nim,
            'phone'=> $request->phone,
            'alamat' => $request->alamat
        ]);
    }

    public function addSKS(SKSRequest $request,$user): void
    {
        $sks = new usermatkul();
        $sks->user_id = $user->id;
        $sks->matakuliah_id = $request->matakuliah_id;
        $sks->save();
    }

    public function dataSKS(Request $request)
    {
        $data = usermatkul::with('matkul')->where('user_id',$request->user_id)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataMatkul(Request $request)
    {
        $userId = $request->user_id;
        $dataMatkul = MataKuliah::whereDoesntHave('users', function($query) use ($userId){
            $query->where('user_id',$userId);
        })->get();
        return DataTables::of($dataMatkul)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $btn = "<button class=\"btn btn-sm btn-success m-1 open-matkul\" data-id=\"$row->id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalAdd\"> <i class=\"fa fa-plus\"></i></button>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


}
