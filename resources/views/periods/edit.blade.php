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
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#areYouSure">
        Delete Period
        </button>
    </div>

{{-- Modal --}}
    <div id="areYouSure" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Are you sure?</h4>

          </div>
          <div class="modal-body">
            <p>Deleting this Period will delete all associated Salary transactions</p>
          </div>
          <div class="modal-footer">
            <form method="POST" action="/periods/{{$period->id}}">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Yes, permanently delete period and all related salaries data</button>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

@section('extra_scripts')
@stop