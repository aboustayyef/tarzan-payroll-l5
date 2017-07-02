<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Period extends Model
{
	protected $guarded = [];

    public function getDateAttribute($date){
		$c = new Carbon($date);
		return $c->format('d/m/Y');
	}
	public function setDateAttribute($date){
		$c = Carbon::createFromFormat('d/m/Y', $date);
		$this->attributes['date'] = $c;
	}
}
