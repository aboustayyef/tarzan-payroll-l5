<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use Carbon\Carbon;

class PeriodsController extends Controller
{
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
        Period::create([
            'date'  =>  $request->get('date'),
            'has_basic_rate'    => $request->get('has_basic_rate'),
            'description'   =>  $description,
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
