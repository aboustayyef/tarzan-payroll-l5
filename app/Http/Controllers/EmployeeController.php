<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (empty(request()->query())) {
            $sorting='location';
            $direction = 'desc';
        }else{
            $direction = request()->query('direction');
            $sorting = request()->query('sorting');
        }
        $employees = Employee::orderBy($sorting,$direction)->get();
        return view('employees.index')->with(compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $employee = new Employee;
        $employee->soap = 1;
        $employee->disabled = 1;
        $employee->contributes_to_ssf = 1;
        $employee->mode_of_payment = 'cheque';
        return view('employees.create')->with(compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required',
            'tarzan_id' => 'required',
            'tema_sorting_id'   =>  'required',
            'date_of_birth'   =>  'nullable|date_format:d/m/Y',
            'date_joined'   =>  'nullable|date_format:d/m/Y',
            'designation'   =>  'required',
            'basic_pay'     =>  'numeric|min:0',
            'element_car'   =>  'nullable|numeric|min:0',
            'element_rent'   =>  'nullable|numeric|min:0',
            'element_other'   =>  'nullable|numeric|min:0',
            'children'   =>  'nullable|integer|min:0|max:10',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
