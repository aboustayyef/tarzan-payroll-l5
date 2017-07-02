@extends('layouts.app')
@section('content')
<div class="container">
	@if(session()->has('message'))
		<div class="alert alert-info">
			{{session()->get('message')}}
		</div>
	@endif
	<div class="page-header">
		<h1>Create new Employee</h1>
	</div>
	<form method="POST" action="/employees/{{$employee->id}}">
		<input name="_method" type="hidden" value="PUT">

		@include('employees._form')
	<input type="submit" class="btn btn-primary btn-lg" value="Update Employee Info"></input>
	</form>
	<!-- Button trigger modal -->
	<hr>
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#areYouSure">
	  Delete Employee
	</button>

{{-- Modal --}}
	<div id="areYouSure" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Are you sure?</h4>

	      </div>
	      <div class="modal-body">
	        <p>Deleting this employee will remove all their data. Pervious salary transactions will remain in record</p>
	      </div>
	      <div class="modal-footer">
		    <form method="POST" action="/employees/{{$employee->id}}">
		    	{{csrf_field()}}
		    	<input name="_method" type="hidden" value="DELETE">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-danger">Yes, permanently delete employee</button>
		    </form>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</div>

@stop