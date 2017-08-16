<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    private $locations;
    public function __construct()
    {
        parent::__construct();
    }

    public function scopeSeniors($query)
    {
        return $query->whereIn('location', $this->locations['seniors']);
    }

}
