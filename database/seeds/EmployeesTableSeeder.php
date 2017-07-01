<?php

use Illuminate\Database\Seeder;
use App\Employee;
use Carbon\Carbon;
use \League\Csv\Reader;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get CSV file
		$csv = Reader::createFromPath(base_path('database/seeds/employees_seed.csv'));
		// Remove Headers
		$employees = collect($csv->setOffset(1)->fetchAll());

		$employees = $employees->map(function($employee){
			return [
	            'tarzan_id' => $employee[1],
	            'tema_sorting_id' => (int) $employee[43],
	            'name' => $employee[2] ,
	            'date_of_birth' => $employee[3],
	            'date_joined' => $employee[6],
	            'location' => $employee[4],
	            'designation' => $employee[5],
	            'basic_pay' => round(floatval($employee[7]),2),
	            'element_car' => round(floatval($employee[8]),2),
				'element_rent' => round(floatval($employee[9]),2),
				'element_other' => round(floatval($employee[10]),2),
				'union' => $employee[11] == 'TRUE' ? 1 : 0,
				'wife' => (int) $employee[12],
				'children' => (int) $employee[13],
				'contributes_to_ssf' => $employee[14] == 'TRUE' ? 1 : 0,
				'disabled' => $employee[15] == 'TRUE' ? 1 : 0,
				'soap' => $employee[16] == 'TRUE' ? 1 : 0,
				'mode_of_payment' => $employee[17],
				'bank_account_number' => $employee[18] ,
				'bank_name' => $employee[19],
				'residence' => $employee[31],
				'house_number' => $employee[32],
				'contact_number' => $employee[33],
				'advance_amount' => (int) $employee[20],
			];
		});
        // loop through records
		$employees->each(function($employee){
	        // save each record
			Employee::create($employee);
		});
    }
}
