<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitizenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'nik' => $this->nik,
            'no_kk' => $this->no_kk,
            'foto_ktp' => $this->foto_ktp,
            'foto_kk' => $this->foto_kk,
            'umur' => $this->umur,
            'jenis_kelamin' => $this->jenis_kelamin,
            'provinsi' => $this->provinsi,
            'kab_kota' => $this->kab_kota,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'alamat' => $this->alamat,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'b_penghasilan' => $this->b_penghasilan,
            's_penghasilan' => $this->s_penghasilan,
            'alasan' => $this->alasan
        ];
    }
}
