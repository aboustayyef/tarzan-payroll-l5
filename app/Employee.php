<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    protected $guarded = [];

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

	// Date fields accessors and mutators;

	public function getDateJoinedAttribute($date){
		$c = new Carbon($date);
		return $c->format('d/m/Y');
	}
	public function getDateOfBirthAttribute($date){
		$c = new Carbon($date);
		return $c->format('d/m/Y');
	}

	public function setDateJoinedAttribute($date){
		if (empty($date)) {
			$this->attributes['date_joined'] = null;	
		}else{
			$c = Carbon::createFromFormat('d/m/Y', $date);
			$this->attributes['date_joined'] = $c;
		}
	}
	public function setDateOfBirthAttribute($date){
		if (empty($date)) {
			$this->attributes['date_of_birth'] = null;	
		}else{
			$c = Carbon::createFromFormat('d/m/Y', $date);
			$this->attributes['date_of_birth'] = $c;
		}
	}

	public function setDefaults(){
		$this->days_absent = 0;
		$this->element_car = 0.00;
		$this->element_rent= 0.00;
		$this->element_other = 0.00;
		$this->union = 1;
		$this->wife = 1;
		$this->children = 2;
		$this->contributes_to_ssf = 1;
		$this->disabled = 0;
		$this->soap = 0;
		$this->mode_of_payment = 'cheque';
		$this->advance_amount = 0.00;
		$this->other_additions = 0.00;
		$this->other_deductions = 0.00;
	}


	public static function validationRules(){
		$rules = [
            'name'  =>  'required',
            'tarzan_id' => 'required|unique:employees,tarzan_id',
            'tema_sorting_id'   =>  'required',
            'date_of_birth'   =>  'nullable|date_format:d/m/Y',
            'date_joined'   =>  'nullable|date_format:d/m/Y',
            'designation'   =>  'required',
            'basic_pay'     =>  'numeric|min:0',
            'element_car'   =>  'nullable|numeric|min:0',
            'element_rent'   =>  'nullable|numeric|min:0',
            'element_other'   =>  'nullable|numeric|min:0',
            'children'   =>  'nullable|integer|min:0|max:10',
        ];
        // remove unique tarzan_id for editing mode
        if ( request()->isMethod('put')) {
        	$rules['tarzan_id'] = 'required';
        }
        return $rules;
	}
}
