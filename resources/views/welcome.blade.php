@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Welcome to Tarzan Payroll</h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h2>Employees</h2>
            <p>Before creating a new Salaries period, check that all details related to employees are correct. Absentees, Salaries, SSF, etc..</p>
            <a href="/employees" class="btn btn-default">Manage Employees</a>
            <a href="/absentees" class="btn btn-default">Manage Absentees</a>
            <a href="#" class="btn btn-default">Adjust Salaries</a>
            <h2>Salaries</h2>
            <a href="/periods" class="btn btn-default">Manage Periods</a>
            <a href="" class="btn btn-default">View Reports for An Existing Period</a>
        </div>
    </div>
</div>
@endsection
