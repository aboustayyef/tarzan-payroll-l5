@extends('layouts.app')
@section('content')
	<div class="container">
		@if(session()->has('message'))
			<div class="alert alert-success">{{session('message')}}</div>
		@endif
		<h1>Absentees</h1>
		<button id="resetAll" class="btn btn-lg btn-warning pull-right">Reset All</button>
		<form method="POST" action="/absentees">
		{{csrf_field()}}
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th>Sorting ID</th>
					<th>ID</th>
					<th>Name</th>
					<th>Absence</th>
				</tr>
			</thead>
			<tbody>
				@foreach($employees as $employee)
					<tr>
						<th style="width:10%">{{$employee->tema_sorting_id}}</th>
						<td style="width:10%">{{$employee->tarzan_id}}</td>
						<td>{{$employee->name}}</td>
						<td style="width:30px">
							<input class="form-control input-sm absenteeField" name="{{$employee->id}}" type="text" value="{{$employee->days_absent}}">
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<input type="submit" class="btn btn-lg btn-primary pull-right" name="">
		</form>
	</div>
@stop

@section('extra_scripts')
<script>
	// resetting absentees behavior
	var absenteeFields = Array.from(document.getElementsByClassName('absenteeField'));
	resetabsentees = function(){
		absenteeFields.forEach(function(field){
			field.value = 0;
		});
	};
	var resetbutton = document.getElementById('resetAll');
	resetbutton.addEventListener('click', function(){
		resetabsentees();
	});
</script>

@stop