<?php

namespace App\Service\Dosen;

use App\Http\Requests\Dosen\InputNilaiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface NilaiServiceDosen
{
    public function index(Request $request):Collection;

    public function save(InputNilaiRequest $request):void;
}
