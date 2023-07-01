<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelRequest extends FormRequest
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
            $rules['code'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
            $rules['sks'] =  'required|numeric';
        } else {
            $rules['mapel_id'] =  'required|numeric';
            $rules['code'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
            $rules['sks'] =  'required|numeric';
        }
        return $rules;
    }

    public function messages()
    {

        if (in_array($this->method(), ['DELETE'])) {
//            $messages = [
//                'nik.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
//                'nik.numeric' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
//            ];
        } else if(in_array($this->method(),['POST'])){
            $messages = [
                'code.required' => "KODE MATA KULIAH harus diisi !",
                'code.max' => "Panjang karakter maksimal 255 karakter !",
                'name.required' => "NAMA MATA KULIAH harus diisi !",
                'name.max' => "Panjang karakter maksimal 255 karakter !",
                'sks.required' => "Silahkan pilih jumlah SKS !",
                'sks.numeric' => "Silahkan pilih jumlah SKS !",

            ];
        } else {
            $messages = [
                'mapel_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
                'mapel_id.numeric' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
                'code.required' => "KODE MATA KULIAH harus diisi !",
                'code.max' => "Panjang karakter maksimal 255 karakter !",
                'name.required' => "NAMA MATA KULIAH harus diisi !",
                'name.max' => "Panjang karakter maksimal 255 karakter !",
                'sks.required' => "Silahkan pilih jumlah SKS !",
                'sks.numeric' => "Silahkan pilih jumlah SKS !",
            ];
        }
        return $messages;

    }
}
