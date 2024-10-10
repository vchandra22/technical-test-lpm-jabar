<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitizenCreateRequest;
use App\Http\Requests\CitizenUpdateRequest;
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

            // Handle file uploads
            if ($request->hasFile('foto_ktp')) {
                // Store the file and get the path
                $data['foto_ktp'] = $request->file('foto_ktp')->store('uploads/foto_ktp', 'public');
            }

            if ($request->hasFile('foto_kk')) {
                // Store the file and get the path
                $data['foto_kk'] = $request->file('foto_kk')->store('uploads/foto_kk', 'public');
            }

            // Create new citizen with the file paths included
            $citizen = Citizen::create($data);

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

    public function show($id): CitizenResource
    {
        $citizen = Citizen::findOrFail($id);

        if (!$citizen) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'Citizen not found.'
                ]
            ], 404));
        }

        return new CitizenResource($citizen);
    }

    public function update(int $id, CitizenUpdateRequest $request): CitizenResource
    {
        // Find the citizen by ID or fail (throws a 404 if not found)
        $citizen = Citizen::findOrFail($id);

        // Get the validated data from the request
        $data = $request->validated();

        // Handle file uploads for 'foto_ktp' and 'foto_kk'
        if ($request->hasFile('foto_ktp')) {
            // Store the file and update the path
            $data['foto_ktp'] = $request->file('foto_ktp')->store('uploads/foto_ktp', 'public');
        }

        if ($request->hasFile('foto_kk')) {
            // Store the file and update the path
            $data['foto_kk'] = $request->file('foto_kk')->store('uploads/foto_kk', 'public');
        }

        $citizen->fill($data); // Fill with validated data
        $citizen->save(); // Save changes

        // Return the updated citizen resource
        return new CitizenResource($citizen);
    }
}
