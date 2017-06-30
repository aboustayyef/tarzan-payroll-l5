@extends('layouts.app')
@section('content')
	<div class="container">
		<h1>You're here</h1>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th><a href="/employees?sorting=name&direction={{request()->query('direction') == 'desc' ? 'asc' : 'desc'}}">Name</a></th>
					<th><a href="/employees?sorting=location&direction={{request()->query('direction') == 'desc' ? 'asc' : 'desc'}}">Location</a></th>
					<th><a href="/employees?sorting=designation&direction={{request()->query('direction') == 'desc' ? 'asc' : 'desc'}}">Designation</a></th>
					<th><a href="/employees?sorting=basic_pay&direction={{request()->query('direction') == 'desc' ? 'asc' : 'desc'}}">Basic Pay</a></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($employees as $employee)
					<tr>
						<th>{{$employee->tarzan_id}}</th>
						<td>{{$employee->name}}</td>
						<td>{{$employee->location}}</td>
						<td>{{$employee->designation}}</td>
						<td>{{number_format($employee->basic_pay,2)}}</td>
						<td><a href="{{route('employees.edit', $employee->id)}}">edit</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop

@section('extra_scripts')
@stop