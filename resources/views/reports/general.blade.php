{{-- 
    $salaries [App/Salaries]
    $group [array]
    $subGroup [array]
    $transaction [App/Transaction]
 --}}
@extends('layouts.app')
@section('content')
    <div class="container">
    @foreach($salaries->groups() as $groupName => $group)
        <h2>{{$groupName}}</h2>
        <hr>
        @foreach($group as $subGroupName => $subGroup)
            <h3>{{$subGroupName}} {{$subGroup->count()}}</h3>

            @foreach($subGroup as $transaction)
                <h4>{{$transaction->employee->name}}</h4>
            @endforeach
        @endforeach
    @endforeach
    </div>
@stop