<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\MahasiswaRequest;
use Illuminate\Http\Request;

interface MahasiswaService
{
    public function index(Request $request);
    public function save(MahasiswaRequest $request):void;
    public function update(MahasiswaRequest $request):void;
}
