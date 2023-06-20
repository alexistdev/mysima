<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MapelRequest;
use Exception;
use App\Service\Admin\MapelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MataPelajaran extends Controller
{
    protected $users;
    protected MapelService $mapelService;

    public function __construct(MapelService $mapelService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->mapelService = $mapelService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->mapelService->index($request);
        }
        return view('admin.mapel', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'mapel',
        ));
    }

    public function store(MapelRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $this->mapelService->save($request);
            DB::commit();
            return redirect(route('adm.mapel'))->with(['success' => "Data Mata Kuliah Berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.mapel'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
