@extends('layouts.app')
@section('content')
	<div class="container">
		@if(session()->has('message'))
			<div class="alert alert-info">
				{{session()->get('message')}}
			</div>
		@endif
		<h1>Periods</h1>
			<a href="/periods/create" class="btn btn-default">Create New</a>
			@if($periods->count() > 0)
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Description</th>
						<th>Has Basic Rate</th>
						<th>Has Transactions</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($periods as $period)
						<tr>
							<th>{{$period->id}}</th>
							<td>{{$period->description}}</td>
							<td>{{$period->has_basic_rate ? 'Yes' : 'No'}}</td>
							<td>{{$period->hasTransactions() ? 'Yes' : 'No'}}</td>
							<td><a href="{{route('periods.edit', $period->id)}}">edit</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			@else
				<h2>There Are no periods yet</h2>
			@endif
	</div>
@stop

@section('extra_scripts')
@stop