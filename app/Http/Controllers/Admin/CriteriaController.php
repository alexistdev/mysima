<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminTrait;
use App\Models\Criteria;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CriteriaController extends Controller
{
    use AdminTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $criteria = Criteria::all();
            return DataTables::of($criteria)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->make(true);
        }
        return view('admin.criteria', array(
            'judul' => "Dashboard Administrator | MySima",
            'menuUtama' => 'master',
            'menuKedua' => 'criteria',
        ));
    }
}
