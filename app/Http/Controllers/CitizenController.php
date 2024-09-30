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
        $searchTerm = $request->input('search', '');

        $citizens = Citizen::where(function (Builder $builder) use ($searchTerm) {
            if ($searchTerm) {
                $builder->where(function (Builder $query) use ($searchTerm) {
                    $query->orWhere('nama', 'like', '%' . $searchTerm . '%')
                        ->orWhere('nik', 'like', '%' . $searchTerm . '%')
                        ->orWhere('no_kk', 'like', '%' . $searchTerm . '%')
                        ->orWhere('umur', 'like', '%' . $searchTerm . '%')
                        ->orWhere('provinsi', 'like', '%' . $searchTerm . '%')
                        ->orWhere('kab_kota', 'like', '%' . $searchTerm . '%')
                        ->orWhere('kecamatan', 'like', '%' . $searchTerm . '%')
                        ->orWhere('kelurahan', 'like', '%' . $searchTerm . '%')
                        ->orWhere('alamat', 'like', '%' . $searchTerm . '%');
                });
            }
        });

        $citizens = $citizens->paginate(perPage: $size, page: $page);

        return new CitizenCollection($citizens);
    }
}
