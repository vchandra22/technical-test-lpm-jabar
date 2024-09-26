<?php

namespace Database\Seeders;

use App\Models\Citizen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Citizen::create([
                'nama' => 'John Doe ' . $i,
                'nik' => '350518031100000' . $i,
                'no_kk' => '350518031100000' . $i,
                'foto_ktp' => 'test',
                'foto_kk' => 'test',
                'umur' => '2' . $i,
                'jenis_kelamin' => 'Laki-laki',
                'provinsi' => 'Jawa Barat',
                'kab_kota' => 'Cikeas',
                'kecamatan' => 'Cikeas',
                'kelurahan' => 'Sukamaju',
                'alamat' => 'Jl. Bunga Matahari No. 11' . $i,
                'rt' => '0' . $i,
                'rw' => '0' . $i,
                'b_penghasilan' => '3.486.90' . $i,
                's_penghasilan' => '2.566.095' . $i,
                'alasan' => 'test',
            ]);
        }
    }
}
