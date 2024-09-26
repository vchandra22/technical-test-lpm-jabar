<?php

namespace App\Http\Controllers;

use App\Http\Resources\CitizenCollection;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitizenController extends Controller
{
    public function search(Request $request): CitizenCollection
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

        $citizens = Citizen::where(function (Builder $builder) use ($request) {
            $nama = $request->input('nama');
            if ($nama) {
                $builder->where(function (Builder $builder) use ($nama) {
                    $builder->orWhere('nama', 'like', '%' . $nama . '%');
                });
            }

            $nik = $request->input('nik');
            if ($nik) {
                $builder->where('nik', 'like', '%' . $nik . '%');
            }

            $no_kk = $request->input('no_kk');
            if ($no_kk) {
                $builder->where('no_kk', 'like', '%' . $no_kk . '%');
            }

            $umur = $request->input('umur');
            if ($umur) {
                $builder->where('umur', 'like', '%' . $umur . '%');
            }

            $provinsi = $request->input('provinsi');
            if ($provinsi) {
                $builder->where('provinsi', 'like', '%' . $provinsi . '%');
            }

            $kab_kota = $request->input('kab_kota');
            if ($kab_kota) {
                $builder->where('kab_kota', 'like', '%' . $kab_kota . '%');
            }

            $provinsi = $request->input('provinsi');
            if ($provinsi) {
                $builder->where('provinsi', 'like', '%' . $provinsi . '%');
            }

            $kecamatan = $request->input('kecamatan');
            if ($kecamatan) {
                $builder->where('kecamatan', 'like', '%' . $kecamatan . '%');
            }

            $kelurahan = $request->input('kelurahan');
            if ($kelurahan) {
                $builder->where('kelurahan', 'like', '%' . $kelurahan . '%');
            }

            $alamat = $request->input('alamat');
            if ($alamat) {
                $builder->where('alamat', 'like', '%' . $alamat . '%');
            }
        });

        $citizens = $citizens->paginate(perPage: $size, page: $page);

        return new CitizenCollection($citizens);
    }
}
