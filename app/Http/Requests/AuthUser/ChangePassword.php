<?php

namespace App\Http\Requests\AuthUser;

use App\Http\Requests\BaseRequest;

class ChangePassword extends BaseRequest
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
            'password_lama' => 'required|exists:siswa,password',
            'password_baru' => 'required|different:password_lama'
        ];
    }
}
