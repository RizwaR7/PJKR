<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class M_fakRequest extends FormRequest
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
			'nm_fak' => 'required',
			'id_dekan' => 'required',
			'strata' => 'required',
			'akreditasi' => 'required',
			'no_skfak' => 'required',
			'ts_berlaku' => 'required',
			'profil' => 'required',
			'url' => 'required',
        ];
    }
}
