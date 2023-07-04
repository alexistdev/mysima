<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MahasiswaRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
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


}
