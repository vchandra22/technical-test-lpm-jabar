<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitizenCreateRequest;
use App\Http\Resources\CitizenCollection;
use App\Http\Resources\CitizenResource;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

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

    public function store(CitizenCreateRequest $request): JsonResponse
    {
        try {
            // Validate request data
            $data = $request->validated();

            // Check if email already exists
            if (Citizen::where('nik', $data['nik'])->exists()) {
                // Throw an exception if the email is already registered
                throw new HttpResponseException(response()->json([
                    "errors" => [
                        "nik" => [
                            "NIK already registered"
                        ]
                    ]
                ], 400));
            }

            // Create new citizen
            $citizen = new Citizen($data);
            $citizen->save();

            // Return success response
            return (new CitizenResource($citizen))
                ->response()
                ->setStatusCode(201);
        } catch (HttpResponseException $e) {
            // Handle the custom response exception thrown
            throw $e;
        } catch (Exception $e) {
            // Handle any other exceptions
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'Something went wrong',
                    'details' => $e->getMessage()
                ]
            ], 500));
        }
    }
}
