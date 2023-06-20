<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\MapelRequest;
use App\Models\Criteria;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MapelServiceServiceImplementation implements MapelService
{
    public function index(Request $request)
    {
            $mapel = MataKuliah::orderBy('id','DESC')->get();
            return DataTables::of($mapel)
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

    public function save(MapelRequest $request): void
    {
        $mapel = new MataKuliah();
        $mapel->code = $request->code;
        $mapel->name = $request->name;
        $mapel->sks = $request->sks;
        $mapel->save();
    }
}
