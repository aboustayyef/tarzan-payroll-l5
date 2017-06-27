<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
	protected $dates = [
		'created_at', 'updated_at', 'date_of_birth', 'date_joined'
	];

	public static function get_by_tarzan_id($tarzan_id = ''){
		$count = Static::where('tarzan_id', $tarzan_id)->count() > 0;
		if ($count) {
			return Static::where('tarzan_id', $tarzan_id)->first();
		}
		return 0;
	}

	public function calculate_total_elements(){
		return $this->element_car + $this->element_house + $this->element_other;
	}

	public function calculate_total_emoluments(){
		return $this->calculate_total_elements() + $this->basic_pay;
	}

	public function calculate_net_taxable($value='')
	{
		# code...
	}

	public function calculate_tax(){

	}

	public function calculate_take_home(){

	}
}
