<?php

namespace App\Http\Controllers;

use App\Period;
use App\Salaries;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Period $period, $reportType = 'general')
    {
        $available_reports = ['general'];
        if (! in_array($reportType, $available_reports)) {
            throw new \Exception("report [$reportType] not available", 1);
        }

        $transactions = $period->transactions;
        $salaries = new Salaries($transactions);
        return view('reports.' . $reportType)->with(compact('salaries'))->with(compact('period'));
    }
}
