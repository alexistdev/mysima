<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\KelasRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

interface KelasService
{
    public function index(Request $request);
    public function save(KelasRequest $request):void;
    public function get_data_mahasiswa_kelas(Request $request):JsonResponse;
}
