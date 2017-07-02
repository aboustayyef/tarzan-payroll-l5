@extends('layouts.app')
@section('content')
	<form method="post" action="/periods">
	{{csrf_field()}}
	<div class="container">
	@if(session()->has('message'))
		<div class="alert alert-warning">{{session()->get('message')}}</div>
	@endif
		<h1 class="page-header">Create a New Period</h1>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
					<label for="date" class="control-label">Pick a date in the month for which this payroll is to be made</label>
					<input class="form-control" placeholder="dd/mm/yyyy" name="date" type="text" id="date" value="{{old('date', $period->date)}}">
					<small class="text-danger">{{ $errors->first('date') }}</small>
				</div>
				<div class="form-group">
					<label for="has_basic_rate" class="control-label">Does this month have a Basic Rate?</label>
					<select class="form-control" name="has_basic_rate" id="has_basic_rate">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-lg btn-primary">
		</form>
	</div>
@stop

@section('extra_scripts')
@stop