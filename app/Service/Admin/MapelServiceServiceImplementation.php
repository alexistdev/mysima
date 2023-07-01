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
                    $btn = "<button class=\"btn btn-sm btn-primary ml-1 open-edit\" data-id=\"$row->id\" data-sks=\"$row->sks\" data-name=\"$row->name\" data-code=\"$row->code\" data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"> Edit</button>";
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

    public function update(MapelRequest $request): void
    {
       $mapel = MataKuliah::findOrFail($request->mapel_id);
       $mapel->where('id',$request->mapel_id)->update([
          'name' => $request->name,
          'code' => $request->code,
          'sks' => $request->sks
       ]);
    }


}
