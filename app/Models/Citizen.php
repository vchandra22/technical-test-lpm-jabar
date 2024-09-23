<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $table = "citizens";
    protected $primaryKey = "id";

    protected $fillable = [
        'nama',
        'nik',
        'no_kk',
        'foto_ktp',
        'foto_kk',
        'umur',
        'jenis_kelamin',
        'provinsi',
        'kab_kota',
        'kecamatan',
        'kelurahan',
        'alamat',
        'rt',
        'rw',
        'b_penghasilan',
        's_penghasilan',
        'alasan'
    ];
}
