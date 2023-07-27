<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KelasRequest;
use Exception;
use App\Service\Admin\KelasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    protected $users;
    protected KelasService $kelasService;

    public function __construct(KelasService $kelasService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->kelasService = $kelasService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->kelasService->index($request);
        }
        return view('admin.kelas', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'kelas',
        ));
    }

    public function store(KelasRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->kelasService->save($request);
            DB::commit();
            return redirect(route('adm.kelas'))->with(['success' => "Data Kelas Berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.kelas'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
