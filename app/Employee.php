<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
	protected $dates = [
		'created_at', 'updated_at'
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

	public static function validationRules(){
		return [
            'name'  =>  'required',
            'tarzan_id' => 'required',
            'tema_sorting_id'   =>  'required',
            'date_of_birth'   =>  'nullable|date_format:d-m-Y',
            'date_joined'   =>  'nullable|date_format:d-m-Y',
            'designation'   =>  'required',
            'basic_pay'     =>  'numeric|min:0',
            'element_car'   =>  'nullable|numeric|min:0',
            'element_rent'   =>  'nullable|numeric|min:0',
            'element_other'   =>  'nullable|numeric|min:0',
            'children'   =>  'nullable|integer|min:0|max:10',
        ];
	}
}
