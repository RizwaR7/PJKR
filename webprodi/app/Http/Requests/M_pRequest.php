<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class M_pRequest extends FormRequest
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
			'nm_ps' => 'required',
			'nim_ps' => 'required',
			'strata' => 'required',
			'akre' => 'required',
			'id_ka' => 'required',
			'no_sk' => 'required',
			'ts_sk' => 'required',
			'ts_berlaku' => 'required',
			'url_ps' => 'required',
			'nm_ps_sister' => 'required',
			'id_fak' => 'required',
        ];
    }
}
