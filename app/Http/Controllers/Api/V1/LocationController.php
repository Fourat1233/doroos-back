<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Api\LocationRepository;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    
     /**
     * @var LocationRepository
     */
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function loadAll(): JsonResponse {
        $locations = $this->locationRepository->locationsList();
        return response()->json($locations);
    }
}
