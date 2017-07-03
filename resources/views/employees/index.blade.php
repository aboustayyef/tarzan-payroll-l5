@extends('layouts.app')
@section('content')

	<div id="app" class="container">
		@if(session()->has('message'))
			<div class="alert alert-info">
				{{session()->get('message')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif

		<div class="page-header">
			<div class="row">
				<div class="col-md-8">
					<h1>Tarzan Employees<h1>
				</div>
				<div class="col-md-3 col-md-offset-1">
					<input type="text" v-model="filter_key" class="form-control pull-right">
				</div>
			</div>
		</div>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th><a @click="sort" data-sort="name" href="#">Name</a></th>
					<th><a @click="sort" data-sort="location" href="#">Location</a></th>
					<th><a @click="sort" data-sort="designation" href="#">Designation</a></th>
					<th><a @click="sort" data-sort="basic_pay" href="#">Basic Pay</a></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="employee in this.filtered_employees" v-if="appReady"> 
					<th v-text="employee.tarzan_id"></th>
					<td>@{{employee.name}}</td>
					<td>@{{employee.location}}</td>
					<td>@{{employee.designation}}</td>
					<td>@{{employee.basic_pay}}</td>
					<td><a :href=`/employees/${employee.id}/edit`>edit</a></td>
				</tr>
			</tbody>
		</table>
	</div>
@stop

@section('extra_scripts')
	<script>
		var app = new Vue({
			el: '#app',
			mounted(){
				axios.get('/api/employees').then((response) => {
					this.all_employees = response.data;
					this.appReady = 1;
					console.log('employees loaded');
				});
			},
			data: {
				message: 'Hello Vue!',
				appReady : 0,
				all_employees: [],
				filter_key: "",
				
			},
			computed: {
			    // a computed getter
			    filtered_employees: function () {
			    	return this.all_employees.filter((emp) =>
			    		(emp.name.toLowerCase().includes(this.filter_key.toLowerCase()) || emp.location.toLowerCase().includes(this.filter_key.toLowerCase()) || emp.tarzan_id.toLowerCase().includes(this.filter_key.toLowerCase()) || emp.designation.toLowerCase().includes(this.filter_key.toLowerCase()))
			    	);
			    }
			  },
			methods:
			{
				sort: function(e){
					// sort by name
					var sorting_key = e.target.dataset.sort;
					this.all_employees.sort(function(a, b) {
					  var valueA = a[sorting_key].toUpperCase(); // ignore upper and lowercase
					  var valueB = b[sorting_key].toUpperCase(); // ignore upper and lowercase
					  if (valueA < valueB) {
					    return -1;
					  }
					  if (valueA > valueB) {
					    return 1;
					  }
					  // names must be equal
					  return 0;
					});
				}
			},
		});
	</script>
@stop