<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MapelRequest;
use App\Http\Requests\Admin\SKSRequest;
use App\Models\Dosen;
use App\Models\User;
use App\Models\usermatkul;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\isEmpty;

class DosenServiceImplementation implements DosenService
{
    public function index(Request $request)
    {
        $user = User::with('dosen')->where('role_id', "2")->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $url = route('adm.dosen.edit', $row->id);
                $detail = route('adm.dosen.detail', base64_encode($row->id));
                $btn = "<a href=\"$detail\"><button class=\"btn btn-sm btn-primary m-1\" > View</button></a>";
                $btn = $btn. "<a href=\"$url\"><button class=\"btn btn-sm btn-success m-1\" > Edit</button></a>";
                $btn = $btn . "<button class=\"btn btn-sm btn-danger m-1 open-hapus\" data-id=\"$row->id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"> Hapus</button>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(DosenRequest $request): void
    {
        $user = new User();
        $user->role_id = 2;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $idUser = $user->id;

        $dosen = new Dosen();
        $dosen->user_id = $idUser;
        $dosen->nik = $request->nik;
        $dosen->phone = $request->phone;
        $dosen->alamat = $request->alamat;
        $dosen->save();
    }

    public function update(DosenRequest $request): void
    {
        $dataArray = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if (!is_null($request->password)) {
            $dataArray['password'] = Hash::make($request->password);
        }
        User::where('id', $request->user_id)->update($dataArray);
        Dosen::where('user_id', $request->user_id)->update([
            'nik'=> $request->nik,
            'phone'=> $request->phone,
            'alamat' => $request->alamat
        ]);
    }

    public function delete(DosenRequest $request): void
    {
        User::where('id',$request->user_id)->delete();
    }

    public function addSKS(SKSRequest $request, $user): void
    {
        $sks = new usermatkul();
        $sks->user_id = $user->id;
        $sks->matakuliah_id = $request->matakuliah_id;
        $sks->save();
    }


}
