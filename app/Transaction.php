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
    
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function cash()
    {
        return $this->mode_of_payment == 'cash';
    }

    public function cheque()
    {
        return $this->mode_of_payment == 'cheque';
    }
}
