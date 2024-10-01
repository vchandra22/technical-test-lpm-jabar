<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CitizenCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'unique:citizens,nik'],
            'no_kk' => ['required', 'unique:citizens,no_kk'],
            'foto_ktp' => ['required'], // Assuming it's a URL or file path
            'foto_kk' => ['required'],  // Assuming it's a URL or file path
            'umur' => ['required', 'integer'],    // Age must be an integer
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'], // Enum values
            'provinsi' => ['required', 'string'],
            'kab_kota' => ['required', 'string'],
            'kecamatan' => ['required', 'string'],
            'kelurahan' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'rt' => ['required'],
            'rw' => ['required'],
            'b_penghasilan' => ['required'],
            's_penghasilan' => ['required'],
            'alasan' => ['required', 'string'], // Assuming this is a text field
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
