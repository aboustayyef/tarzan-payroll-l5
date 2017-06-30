@extends('layouts.app')
@section('content')
<div class="container">
	<div class="page-header">
		<h1>Create new Employee</h1>
	</div>
	<form method="POST" action="/employees/{{$employee->id}}">
		<input name="_method" type="hidden" value="PUT">

		@include('employees._form')
	<input type="submit" class="btn btn-primary" value="update"></input>
	</form>
</div>
@stop