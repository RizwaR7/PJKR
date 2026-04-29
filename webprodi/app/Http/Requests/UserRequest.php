<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
        [
			/* 'password' => 'required',
			'sid' => 'required',
			'pass' => 'required',
			'aktif' => 'required',
			'tingkat' => 'required',
			'induk' => 'required',
			'jumlahlogin' => 'required',
			'ts_login' => 'required',
			'ts_logout' => 'required',
			'ip' => 'required',
			'id_ps' => 'required', */
        ];
    }
}
