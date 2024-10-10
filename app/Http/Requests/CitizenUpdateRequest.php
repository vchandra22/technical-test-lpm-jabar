<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CitizenUpdateRequest extends FormRequest
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
            'nama' => ['nullable', 'string', 'max:255'],
            'nik' => ['nullable'],
            'no_kk' => ['nullable'],
            'foto_ktp' => ['nullable'], // Assuming it's a URL or file path
            'foto_kk' => ['nullable'],  // Assuming it's a URL or file path
            'umur' => ['nullable', 'integer'],    // Age must be an integer
            'jenis_kelamin' => ['nullable', 'in:Laki-laki,Perempuan'], // Enum values
            'provinsi' => ['nullable', 'string'],
            'kab_kota' => ['nullable', 'string'],
            'kecamatan' => ['nullable', 'string'],
            'kelurahan' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'rt' => ['nullable'],
            'rw' => ['nullable'],
            'b_penghasilan' => ['nullable'],
            's_penghasilan' => ['nullable'],
            'alasan' => ['nullable', 'string'], // Assuming this is a text field
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
