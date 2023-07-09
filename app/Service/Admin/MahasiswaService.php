<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\MahasiswaRequest;
use App\Http\Requests\Admin\SKSRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface MahasiswaService
{
    public function index(Request $request);
    public function save(MahasiswaRequest $request):void;
    public function update(MahasiswaRequest $request):void;
    public function addSKS(SKSRequest $request,$user):void;
    public function dataSKS(Request $request);
    public function dataMatkul(Request $request);
}
