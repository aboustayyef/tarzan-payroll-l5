@extends('layouts.app')
@section('content')
    <form method="post" action="/periods/{{$period->id}}">
        <input name="_method" type="hidden" value="PUT">
        {{csrf_field()}}
    <div class="container">
    <a href="/periods" class="btn btn-warning">Cancel and Go Back</a>
    @if(session()->has('message'))
        <div class="alert alert-warning">{{session()->get('message')}}</div>
    @endif
        <h1 class="page-header">Edit Period</h1>
        <div class="row">
            @include('periods._form') 
        </div>
            <input type="submit" class="btn btn-lg btn-primary">
        </form>
    </div>
@stop

@section('extra_scripts')
@stop