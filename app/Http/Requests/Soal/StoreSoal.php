<?php

namespace App\Http\Requests\Soal;

use App\Http\Requests\BaseRequest;

class StoreSoal extends BaseRequest
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
            'soal.kelas' => 'required',
            'soal.mapel' => 'required',
            'soal.paket' => 'required',
            'soal.jenis' => 'required',
            'soal.nama' => 'required',
            'soal.soal' => 'required',
            'soal.soal_media' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/3gpp',
            'jawaban.essai' => 'required_if:soal.jenis,essai',
            'soal.jumlah_pilihan' => 'required_if:soal.jenis,pilihan_ganda',
            'jawaban.pilgan.*.jawaban' => 'required_if:soal.jenis,pilihan_ganda',
            'jawaban.pilgan.*.media' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/3gpp',
            'jawaban.benar' => 'required_if:soal.jenis,pilihan_ganda'
        ];
    }
}
