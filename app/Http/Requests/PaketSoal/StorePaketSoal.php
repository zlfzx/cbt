<?php

namespace App\Http\Requests\PaketSoal;

use App\Http\Requests\BaseRequest;

class StorePaketSoal extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'keterangan' => 'nullable',
            'kelas_id' => 'required',
            'mapel_id' => 'required'
        ];
    }
}
