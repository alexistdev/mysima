<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DosenRequest;
use App\Service\Admin\DosenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class DosenController extends Controller
{
    protected $users;
    protected DosenService $dosenService;

    public function __construct(DosenService $dosenService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->dosenService = $dosenService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->dosenService->index($request);
        }
        return view('admin.dosen', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'dosen',
        ));
    }

    public function create()
    {
        return view('admin.adddosen', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'dosen',
        ));
    }

    public function store(DosenRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $this->dosenService->save($request);
            DB::commit();
            return redirect(route('adm.dosen'))->with(['success' => "Data Dosen Berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.dosen'))->withErrors(['error' => $e->getMessage()]);
        }

    }
}
