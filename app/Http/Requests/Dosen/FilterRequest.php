<?php

namespace App\Http\Requests\Dosen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterRequest extends FormRequest
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
        $rules['skripsi'] =  'required|numeric';
        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'skripsi.required' => "Silahkan pilih skripsi terlebih dahulu!",
            'skripsi.numeric' => "Silahkan pilih skripsi terlebih dahulu!",
        ];
        return $messages;
    }

}
