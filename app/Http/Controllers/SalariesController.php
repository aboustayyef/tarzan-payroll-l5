<?php

namespace App\Http\Controllers;

use App\Period;
use App\Transaction;
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    public function index(Period $period)
    {
        return $period->transactions;
    }
}
