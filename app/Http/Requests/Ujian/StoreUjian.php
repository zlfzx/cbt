<?php

namespace App\Http\Requests\Ujian;

use App\Http\Requests\BaseRequest;

class StoreUjian extends BaseRequest
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
            'kelas_id' => 'required|exists:kelas,id',
            'paket_soal_id' => 'required|exists:paket_soal,id',
            'nama' => 'required',
            'waktu_mulai' => 'required',
            'waktu_ujian' => 'required'
        ];
    }
}
