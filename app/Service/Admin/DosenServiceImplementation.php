<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\MapelRequest;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DosenServiceImplementation implements DosenService
{
    public function index(Request $request)
    {
        $user = User::where('role_id', "2")->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $btn = "<button class=\"btn btn-sm btn-primary ml-1 open-edit\" data-id=\"$row->id\" data-name=\"$row->name\" data-email=\"$row->email\" data-toggle=\"modal\" data-target=\"#modalEdit\"> Edit</button>";
                $btn = $btn . "<button class=\"btn btn-sm btn-danger ml-1 open-hapus\" data-id=\"$row->id\" data-toggle=\"modal\" data-target=\"#modalHapus\"> Hapus</button>";
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

}
