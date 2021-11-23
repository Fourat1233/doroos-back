<?php


namespace App\Http\Repositories\Api;

use App\Location;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class LocationRepository
{
    /**
     * @var Location
     */
    private $location;


    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Return a paginated list of location
     * @return Paginator paginated list of locations
     */
    public function locationsList(): Paginator
    {
        return $this->location->newQuery()->paginate(99);
    }
}



