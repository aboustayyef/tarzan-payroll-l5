@extends('layouts.app')
@section('content')
<div class="container">

	<div class="page-header">
		<h1>Create new Employee</h1>
	</div>
	<form method="POST" action="/employees" >
		@include('employees._form')
	<input type="submit" class="btn btn-primary"></input>
	</form>
</div>
@stop