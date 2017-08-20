{{-- 
    $period [App/Period]
    $salaries [App/Salaries]
    $group [array]                      // Seniors - Juniors 
    $subGroup [array]                   // Managment - Directors - Tema Main (...etc)
    $transaction [App/Transaction]      // name, basic pay, absence (...etc)  

 --}}

@extends('layouts.app')
@section('content')
    <div class="container">
    @foreach($salaries->groups() as $groupName => $group)
        <h2>{{$groupName}}</h2>
        <table class="table table-striped table-condensed" style="font-size:8px">
        <thead>
            <tr>
                <th>Name</th>
                <th>I.D</th>
                <th>Basic Pay</th>
                <th>Elems.</th>
                <th>Total<br>Emols.</th>
                <th>SSF<br>Employee</th>
                <th>C.M.<br>Relief</th>
                <th>Net<br>Taxable</th>
                <th>Tax<br>Payable</th>
                <th>Absence</th>
                <th>Advance</th>
                <th>TUC</th>
                <th>FF<br>Levy</th>
                <th>Other<br>Deductions</th>
                <th>Other<br>Additions</th>
                <th>Tk. Home<br>Cash</th>
                <th>Tk. Home<br>Cheque</th>
                <th>SSF<br>Employer</th>
            </tr>
        </thead>
        <tbody>
        @foreach($group as $subGroupName => $subGroup)
            {{$subGroupName}} {{$subGroup->count()}}
            @foreach($subGroup as $transaction)
                <tr>
                    <td>{{$transaction->employee->name}}</td>
                    <td>{{$transaction->employee->tarzan_id}}</td>
                    <td>{{$transaction->basic_pay}}</td>
                    <td>{{$transaction->elements}}</td>
                    <td>{{$transaction->total_emoluments}}</td>
                    <td>{{$transaction->ssf_contribution_employee}}</td>
                    <td>{{$transaction->children_marriage_relief}}</td>
                    <td>{{$transaction->net_taxable}}</td>
                    <td>{{$transaction->tax_payable}}</td>
                    <td>{{$transaction->absence_deduction}}</td>
                    <td>{{$transaction->advance_amount}}</td>
                    <td>{{$transaction->union_dues}}</td>
                    <td>{{$transaction->ff_levy}}</td>
                    <td>{{$transaction->other_deductions}}</td>
                    <td>{{$transaction->other_additions}}</td>
                    <td>@if($transaction->mode_of_payment == 'cash') {{$transaction->take_home_amount}} @endif</td>
                    <td>@if($transaction->mode_of_payment == 'cheque'){{$transaction->take_home_amount}}@endif</td>
                    <td>{{$transaction->ssf_contribution_employer}}</td>
                </tr>
            @endforeach
        
        @endforeach
        </tbody>
        </table>
    @endforeach
    </div>
@stop