<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\KelasRequest;
use App\Http\Requests\Admin\TambahSiswaNonKelasRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

interface KelasService
{
    public function index(Request $request);
    public function save(KelasRequest $request):void;
    public function get_data_mahasiswa_kelas(Request $request):JsonResponse;
    public function get_data_mahasiswa_non_kelas(Request $request):JsonResponse;
    public function update_siswa(int $user_id,int $kelas_id, int $tipe):void;

}
