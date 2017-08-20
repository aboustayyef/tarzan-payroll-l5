{{-- 
    $period [App/Period]
    $salaries [App/Salaries]
    $group [array]                      // Seniors - Juniors 
    $subGroup [array of collections].   // Managment - Directors - Tema Main (...etc)
    $transaction [App/Transaction]      // name, basic pay, absence (...etc)  

 --}}
<?php 
    $grand_totals = [];
    $grand_totals['basic_pay'] = 0;
    $grand_totals['elements']  = 0;
    $grand_totals['total_emoluments']  = 0;
    $grand_totals['ssf_contribution_employee']  = 0;
    $grand_totals['children_marriage_relief']  = 0;
    $grand_totals['net_taxable']  = 0;
    $grand_totals['tax_payable']  = 0;
    $grand_totals['absence_deduction']  = 0;
    $grand_totals['advance_amount']  = 0;
    $grand_totals['union_dues']  = 0;
    $grand_totals['ff_levy']  = 0;
    $grand_totals['other_deductions']  = 0;
    $grand_totals['other_additions']  = 0;
    $grand_totals['cash']  = 0;
    $grand_totals['cheque']  = 0;
    $grand_totals['ssf_contribution_employer']  = 0;
?>
@extends('layouts.app')
@section('content')
    <div class="container">
    @foreach($salaries->groups() as $groupName => $group)
        <div class="row">
            <div class="container">
                <img src="/img/tarzan-logo.png" width="200px" height="auto"> 
                <h3 class="pull-right">General Report, {{$period->description}} <small>{{$groupName}}</small></h3>
            </div>
        </div>
        <hr>
        @foreach($group as $subGroupName => $subGroup)
            <h3>{{$subGroupName}}</h3> 
            <table class="table table-striped table-condensed" style="font-size:10px">
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
                    @foreach($subGroup as $transaction)
                        <tr>
                            <td>{{$transaction->employee->name}}</td>
                            <td>{{$transaction->employee->tarzan_id}}</td>
                            <td>{{number_format($transaction->basic_pay,2)}}</td>
                            <td>{{number_format($transaction->elements,2)}}</td>
                            <td>{{number_format($transaction->total_emoluments,2)}}</td>
                            <td>{{number_format($transaction->ssf_contribution_employee,2)}}</td>
                            <td>{{number_format($transaction->children_marriage_relief,2)}}</td>
                            <td>{{number_format($transaction->net_taxable,2)}}</td>
                            <td>{{number_format($transaction->tax_payable,2)}}</td>
                            <td>{{number_format($transaction->absence_deduction,2)}}</td>
                            <td>{{number_format($transaction->advance_amount,2)}}</td>
                            <td>{{number_format($transaction->union_dues,2)}}</td>
                            <td>{{number_format($transaction->ff_levy,2)}}</td>
                            <td>{{number_format($transaction->other_deductions,2)}}</td>
                            <td>{{number_format($transaction->other_additions,2)}}</td>
                            <td>@if($transaction->mode_of_payment == 'cash') {{number_format($transaction->take_home_amount,2)}} @endif</td>
                            <td>@if($transaction->mode_of_payment == 'cheque'){{number_format($transaction->take_home_amount,2)}}@endif</td>
                            <td>{{number_format($transaction->ssf_contribution_employer,2)}}</td>
                        </tr>

                    @endforeach {{-- transactions --}}
              </tbody>
              <tfoot>
                  <tr>
                        <th>Totals:</th>
                        <th></th>
                        <th>{{number_format($subGroup->sum->basic_pay,2)}}</th>
                        <th>{{number_format($subGroup->sum('elements'),2)}}</th>
                        <th>{{number_format($subGroup->sum('total_emoluments'),2)}}</th>
                        <th>{{number_format($subGroup->sum('ssf_contribution_employee'),2)}}</th>
                        <th>{{number_format($subGroup->sum('children_marriage_relief'),2)}}</th>
                        <th>{{number_format($subGroup->sum('net_taxable'),2)}}</th>
                        <th>{{number_format($subGroup->sum('tax_payable'),2)}}</th>
                        <th>{{number_format($subGroup->sum('absence_deduction'),2)}}</th>
                        <th>{{number_format($subGroup->sum('advance_amount'),2)}}</th>
                        <th>{{number_format($subGroup->sum('union_dues'),2)}}</th>
                        <th>{{number_format($subGroup->sum('ff_levy'),2)}}</th>
                        <th>{{number_format($subGroup->sum('other_deductions'),2)}}</th>
                        <th>{{number_format($subGroup->sum('other_additions'),2)}}</th>
                        <th>{{number_format($subGroup->filter->cash()->sum->take_home_amount,2)}}</th>
                        <th>{{number_format($subGroup->filter->cheque()->sum->take_home_amount,2)}}</th>
                        <th>{{number_format($subGroup->sum('ssf_contribution_employer'),2)}}</th>
                    </tr>
                    <?php 
                        $grand_totals['basic_pay'] += $subGroup->sum->basic_pay ;
                        $grand_totals['elements'] += $subGroup->sum('elements') ;
                        $grand_totals['total_emoluments'] += $subGroup->sum('total_emoluments') ;
                        $grand_totals['ssf_contribution_employee'] += $subGroup->sum('ssf_contribution_employee') ;
                        $grand_totals['children_marriage_relief'] += $subGroup->sum('children_marriage_relief') ;
                        $grand_totals['net_taxable'] += $subGroup->sum('net_taxable') ;
                        $grand_totals['tax_payable'] += $subGroup->sum('tax_payable') ;
                        $grand_totals['absence_deduction'] += $subGroup->sum('absence_deduction') ;
                        $grand_totals['advance_amount'] += $subGroup->sum('advance_amount') ;
                        $grand_totals['union_dues'] += $subGroup->sum('union_dues') ;
                        $grand_totals['ff_levy'] += $subGroup->sum('ff_levy') ;
                        $grand_totals['other_deductions'] += $subGroup->sum('other_deductions') ;
                        $grand_totals['other_additions'] += $subGroup->sum('other_additions') ;
                        $grand_totals['cash'] += $subGroup->filter->cash()->sum->take_home_amount ;
                        $grand_totals['cheque'] += $subGroup->filter->cheque()->sum->take_home_amount ;
                        $grand_totals['ssf_contribution_employer'] += $subGroup->sum('ssf_contribution_employer') ;
                    ?>
              </tfoot>
            </table>
        @endforeach {{-- / subgroups--}}
        <hr>
        <div class="panel panel-default">
        <div class="panel-heading">Grand Totals for {{$groupName}}</div>
        <div class="panel-body">
            <table class="table table-striped table-condensed" style="font-size:10px">
                <thead>
                        <tr>
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
                    <tr>
                        <th>{{number_format($grand_totals['basic_pay'],2)}}</th>
                        <th>{{number_format($grand_totals['elements'],2)}}</th>
                        <th>{{number_format($grand_totals['total_emoluments'],2)}}</th>
                        <th>{{number_format($grand_totals['ssf_contribution_employee'],2)}}</th>
                        <th>{{number_format($grand_totals['children_marriage_relief'],2)}}</th>
                        <th>{{number_format($grand_totals['net_taxable'],2)}}</th>
                        <th>{{number_format($grand_totals['tax_payable'],2)}}</th>
                        <th>{{number_format($grand_totals['absence_deduction'],2)}}</th>
                        <th>{{number_format($grand_totals['advance_amount'],2)}}</th>
                        <th>{{number_format($grand_totals['union_dues'],2)}}</th>
                        <th>{{number_format($grand_totals['ff_levy'],2)}}</th>
                        <th>{{number_format($grand_totals['other_deductions'],2)}}</th>
                        <th>{{number_format($grand_totals['other_additions'],2)}}</th>
                        <th>{{number_format($grand_totals['cash'],2)}}</th>
                        <th>{{number_format($grand_totals['cheque'],2)}}</th>
                        <th>{{number_format($grand_totals['ssf_contribution_employer'],2)}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        <div class="printer_horizontal_break"></div>
    @endforeach {{-- / groups--}}
    </div>
@stop