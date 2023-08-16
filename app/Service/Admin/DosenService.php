<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\DosenRequest;
use App\Http\Requests\Admin\SKSRequest;
use Illuminate\Http\Request;

interface DosenService
{
    public function index(Request $request);
    public function save(DosenRequest $request):void;
    public function update(DosenRequest $request):void;
    public function delete(DosenRequest $request):void;
    public function addSKS(SKSRequest $request,$user):void;
}
