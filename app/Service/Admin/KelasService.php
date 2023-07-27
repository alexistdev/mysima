<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\KelasRequest;
use Illuminate\Http\Request;

interface KelasService
{
    public function index(Request $request);
    public function save(KelasRequest $request):void;
}
