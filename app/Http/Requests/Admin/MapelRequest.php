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
        } else {
            $rules['user_id'] =  'required|numeric';
        }
        return $rules;
    }
}
