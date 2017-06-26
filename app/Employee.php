<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
	protected $dates = [
		'created_at', 'updated_at', 'date_of_birth', 'date_joined'
	];
}
