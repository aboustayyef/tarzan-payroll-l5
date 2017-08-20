<?php 
namespace App;
use App\Period;
use Illuminate\Database\Eloquent\Collection;

/**
*   A Salaries object is a collection of Transaction objects
*/

class Salaries
{
    public $transactions;
    private $locations;

    public function __construct(Collection $transactions)
    {
        $this->transactions = $transactions;
        $this->locations = 
        [
            'seniors'   =>  ['Directors', 'Management'],
            'juniors'   =>  [ "Accra Head Office", "Blue Gallery Permanent", "Container Depot (Tema)", "Tema Admin", "Tema Permanent" ]
        ];
    }

    public function all()
    {
        return $this->transactions;
    }
    
    public function filterBySeniority($seniority = 'juniors')
    {
        if (! in_array($seniority, ['seniors', 'juniors'])) {
            throw new \Exception("Seniority can be either juniors or seniors");
        }
        $locations = $this->locations;
        return $this->transactions->filter(function($item, $key) use ($locations, $seniority){
            return in_array($item->location, $locations[$seniority]);
        });
    }

    public function filterByLocation($location = 'Tema Admin')
    {
        $allLocations = array_merge($this->locations['seniors'], $this->locations['juniors']);
        if (! in_array($location, $allLocations)) {
            throw new \Exception("Location does not exist");
        }
        return $this->transactions->filter(function($item, $key) use ($location){
            return $item->location == $location;
        });

    }
    public function juniors()
    {
       return $this->filterBySeniority('juniors');
    }
    public function seniors()
    {
       return $this->filterBySeniority('seniors');
    }

    public function groups()
    {
        return collect(
        [
            'Seniors' => 
            [
                'Directors'     =>  $this->filterByLocation('Directors'),
                'Management'    =>  $this->filterByLocation('Management')
            ],

            'Juniors' =>
            [
                "Accra Head Office"         => $this->filterByLocation('Accra Head Office'),
                "Blue Gallery Permanent"    => $this->filterByLocation("Blue Gallery Permanent"),
                "Container Depot (Tema)"    => $this->filterByLocation("Container Depot (Tema)"),
                "Tema Admin"                => $this->filterByLocation("Tema Admin"),
                "Tema Permanent"            => $this->filterByLocation("Tema Permanent")
            ]
        ]
        );
    }
}
?>