<?php

namespace App\Http\Requests\Dosen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputNilaiRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (!Request::routeIs('dosen.*')) {
            return false;
        }
        return Auth::check();
    }


    public function rules(): array
    {
        $rules['usermatkul_id'] =  'required|max:255';
        $rules['nilai_uts'] =  'numeric';
        $rules['nilai_uas'] =  'numeric';
        $rules['nilai_presensi'] =  'numeric';
        $rules['mapel_id'] =  'required|max:255';
        $rules['kelas_id'] =  'required|max:255';
        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'usermatkul_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'usermatkul_id.max' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'mapel_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'mapel_id.max' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'kelas_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'kelas_id.max' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'nilai_uts.numeric' => "Harus berupa angka !",
            'nilai_uas.numeric' => "Harus berupa angka !",
            'nilai_presensi.numeric' => "Harus berupa angka !",
        ];
        return $messages;
    }
}
