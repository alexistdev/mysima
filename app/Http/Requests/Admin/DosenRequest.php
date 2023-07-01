<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenRequest extends FormRequest
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
//            $rules['user_id'] =  'required|numeric';
        } else if(in_array($this->method(),['POST'])){
            $rules['nik'] =  'required|max:255';
            $rules['email'] = [
              'required', 'email','unique:users' ,'max:255'
            ];
            $rules['phone'] =  'nullable|max:255';
            $rules['password'] =  'required|max:255';
            $rules['alamat'] =  'nullable|max:255';
            $rules['name'] =  'required|max:255';
        } else {
            $rules['user_id'] =  'required|numeric';
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
                'nik.required' => "NIK harus diisi !",
                'nik.max' => "Panjang karakter maksimal 255 karakter !",
                'name.required' => "NAMA LENGKAP harus diisi !",
                'name.max' => "Panjang karakter maksimal 255 karakter !",
                'email.required' => "EMAIL harus diisi !",
                'email.max' => "Panjang karakter maksimal 255 karakter !",
                'email.unique' => "EMAIL sudah pernah terdaftar !",
                'email.email' => "EMAIL tidak valid !",
                'phone.max' => "Panjang karakter maksimal 255 karakter !",
                'password.required' => "PASSWORD harus diisi !",
                'password.max' => "Panjang karakter maksimal 255 karakter !",
                'alamat.max' => "Panjang karakter maksimal 255 karakter !"
            ];
        } else {
            $messages = [
                'soal_id.required' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
                'soal_id.numeric' => "ID tidak ditemukan silahkan refresh halaman, atau login ulang!",
            ];
        }
        return $messages;

    }
}