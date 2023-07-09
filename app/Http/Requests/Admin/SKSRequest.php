<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKSRequest extends FormRequest
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
            'matakuliah_id'=>  'required|numeric',
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'matakuliah_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            'matakuliah_id.numeric' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
        ];
        return $messages;
    }
}
