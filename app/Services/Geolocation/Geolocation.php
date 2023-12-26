<?php 
namespace App\Services\Geolocation;

use App\Services\Map\Map;
use App\Services\Satellites\Satellite;
class Geolocation{
    /**
     * Summary of __construct
     * @param \App\Services\Map\Map $map
     * @param \App\Services\Satellites\Satellite $satellite
     */

     private $map;
     private $satellite;
    public function __construct(Map $map,Satellite $satellite){

        $this->map = $map;
        $this->satellite = $satellite;

    }

    public function search(string $username)
    {
        # code...
        $locationInfo = $this->map->findAddress($username);
        return $this->satellite->pinpoint($locationInfo);
    }
}