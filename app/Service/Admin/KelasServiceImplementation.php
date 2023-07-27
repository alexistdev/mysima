<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\KelasRequest;
use App\Models\Kelas;
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
                $btn = "<button class=\"btn btn-sm btn-primary ml-1 open-edit\" data-id=\"$row->id\" data-name=\"$row->name\"  data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"> Edit</button>";
                $btn = $btn . "<button class=\"btn btn-sm btn-danger ml-1 open-hapus\" data-id=\"$row->id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"> Hapus</button>";
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


}
