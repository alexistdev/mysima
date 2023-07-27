<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (!Request::routeIs('adm.*')) {
            return false;
        }
        return Auth::check();
    }

    public function rules(): array
    {
        if (in_array($this->method(), ['DELETE'])) {
            $rules['user_id'] =  'required|numeric';
        } else if(in_array($this->method(),['POST'])){
            $rules['name'] =  'required|max:255';
        } else {
            $rules['kelas_id'] =  'required|numeric';
            $rules['name'] =  'required|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $messages = [
                'kelas_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
                'kelas_id.numeric' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $messages = [
                'name.required' => "NAMA KELAS harus diisi !",
                'name.max' => "Panjang karakter maksimal 255 karakter !"
            ];
        } else {
            $messages = [
                'kelas_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
                'kelas_id.numeric' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
                'name.required' => "NAMA KELAS harus diisi !",
                'name.max' => "Panjang karakter maksimal 255 karakter !",
            ];
        }
        return $messages;
    }
}
