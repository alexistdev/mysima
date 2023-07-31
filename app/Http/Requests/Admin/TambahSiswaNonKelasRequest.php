<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TambahSiswaNonKelasRequest extends FormRequest
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
        $rules = [
            'user_id'=>  'required|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'user_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'user_id.max' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
        ];
        return $messages;
    }
}
