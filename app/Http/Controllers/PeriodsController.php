<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Period;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodsController extends Controller
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
        $periods = Period::all();
        return view('periods.index')->with(compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $period = new Period;
        return view('periods.create')->with(compact('period'));
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
            'date'  =>  'required|date_format:d/m/Y'
        ]);
        $d = Carbon::createFromFormat('d/m/Y', $request->get('date'));
        $description = $d->format('F, Y');

        // check if this date doesn't already exist
        if (Period::where('description',$description)->get()->count() > 0) {
            return redirect(route('periods.create'))->with('message', 'a period with this month already exists');
        }
        $period = Period::create([
            'date'  =>  $request->get('date'),
            'has_basic_rate'    => $request->get('has_basic_rate'),
            'description'   =>  $description,
        ]);

        // Now Create Transactions
        $period->generateAllTransactions();

        return redirect('/periods')->with('message', 'period and all related transactions created');
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
    public function edit(Period $period)
    {
        return view('periods.edit')->with(compact('period'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        $this->validate($request, [
           'date'  =>  'required|date_format:d/m/Y'
        ]);
        $d = Carbon::createFromFormat('d/m/Y', $request->get('date'));
        $description = $d->format('F, Y');

        $period->date  =  $request->get('date');
        $period->has_basic_rate    = $request->get('has_basic_rate');
        $period->description   =  $description;
        $period->save();

        return redirect('/periods')->with('message', 'period succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        // destroy all records related to the period
        $relatedTransactions = $period->transactions;
        foreach ($relatedTransactions as $key => $transaction) {
            $transaction->delete();
        }
        $period->delete();
        return redirect('/periods')->with('message','Period and all its transactions succesfully deleted');
    }
}
