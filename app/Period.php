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

	public function generateAllTransactions(){
		$employees = Employee::all();
		foreach ($employees as $key => $employee) {
			$this->generateTransaction($employee);
			# code...
		}
	}

	public function generateTransaction(Employee $employee){
		$t = new Transaction;
		$t->employee_id = $employee->id;
		$t->period_id = $this->id;
		$t->location = $employee->location;
		$t->designation = $employee->designation;
		$t->basic_pay = $employee->basic_pay;
		$t->element_car = $employee->element_car;
		$t->element_rent = $employee->element_rent;
		$t->element_other = $employee->element_other;
		$t->union = $employee->union;
		$t->wife = $employee->wife;
		$t->children = $employee->children;
		$t->contributes_to_ssf= $employee->contributes_to_ssf;
		$t->disabled = $employee->disabled;
		$t->soap = $employee->soap;
		$t->mode_of_payment = $employee->mode_of_payment;
		$t->bank_account_number = $employee->bank_account_number;
		$t->bank_name = $employee->bank_name;
		$t->advance_amount = $employee->advance_amount;
		$t->days_absent = $employee->days_absent;
		$t->age_above_55 = $employee->age_above_55();
		$t->ssf_contribution_employee = $employee->ssf_contribution_employee();
		$t->ssf_contribution_employer = $employee->ssf_contribution_employer();
		$t->elements = $employee->elements();
		$t->total_emoluments = $employee->total_emoluments();
		$t->total_ssf_contributions = $employee->total_ssf_contributions();
		$t->children_marriage_relief = $employee->children_marriage_relief();
		$t->disability_relief = $employee->disability_relief();
		$t->net_taxable = $employee->net_taxable();
		$t->union_dues = $employee->union_dues();
		$t->absence_deduction = $employee->absence_deduction();
		$t->ff_levy = $employee->ff_levy();
		$t->other_additions = $employee->other_additions;
		$t->other_additions_notes = $employee->other_additions_notes;
		$t->other_deductions = $employee->other_deductions;
		$t->other_deductions_notes = $employee->other_deductions_notes;
		$t->take_home_amount = $employee->take_home_amount();
		$t->tax_payable = $employee->tax_payable();
		$t->save();
	}
}