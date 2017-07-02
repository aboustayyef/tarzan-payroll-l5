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

	public function age(){
		$today = Carbon::now();
		$born = Carbon::createFromFormat('d/m/Y' , $this->date_of_birth);
		return $today->diffInYears($born);
	}
	
	public function age_above_55(){
		return $this->age() >= 55;
	}

	public function ssf_contribution_employee()
	{
		if ($this->contributes_to_ssf) {
			if ($this->age_above_55()) {
				return $this->basic_pay * 0.05;
			} else {
				return $this->basic_pay * 0.055;
			}
			return 0;
		}
	}

	public function ssf_contribution_employer()
	{
		if ($this->contributes_to_ssf) {
			if ($this->age_above_55()) {
				return $this->basic_pay * 0.125;
			} else {
				return $this->basic_pay * 0.13;
			}
			return 0;
		}
	}

	public function total_ssf_contributions()
	{
		return $this->ssf_contribution_employee() + $this->ssf_contribution_employer();
	}

	public function elements()
	{
		return ($this->element_car + $this->element_rent + $this->element_other);
	}

	public function total_emoluments()
	{
		return $this->elements() + $this->basic_pay;
	}
	
	public function children_marriage_relief()
	{
		//(CDbl([wife])*2.5)+IIf([children]>3,CDbl(3*2.5),CDbl([children])*2.5)	
		$effective_children = $this->children > 3 ? 3 : $this->children;
		$cm = $this->wife? 2.5 : 0;
		$cm += $effective_children * 2.5;
		return $cm; 
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
