<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\MapelRequest;
use Illuminate\Http\Request;

interface MapelService
{
    public function index(Request $request);
    public function save(MapelRequest $request):void;
}
