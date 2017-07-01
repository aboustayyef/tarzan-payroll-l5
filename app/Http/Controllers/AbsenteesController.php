<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class AbsenteesController extends Controller
{
    public function index()
    {
		$employees = Employee::where('location','LIKE','%tema%')->whereOr('location','Blue Gallery Permanent')->orderBy('tema_sorting_id','asc')->get();
		return view('absentees.index')->with(compact('employees'));
    }

    public function store(Request $request){
    	
    	$all = $request->except('_token');

    	// apply absence
    	foreach ($all as $id => $abs) {
    		$employee = Employee::find($id);
    		$employee->days_absent = $abs;
    		$employee->save();
    	}

    	return redirect(route('absentees.index'))->with('message', 'Absentees Updated');
    }
}
