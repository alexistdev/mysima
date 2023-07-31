<?php

namespace App\Service\Dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface NilaiServiceDosen
{
    public function index(Request $request):Collection;
}
