<?php

namespace App\Http\Requests\Siswa;

use App\Http\Requests\BaseRequest;

class StoreSiswa extends BaseRequest
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
            'nis' => 'required|unique:siswa',
            'kelas_id' => 'required|exists:kelas,id',
            'password' => 'nullable'
        ];
    }
}
