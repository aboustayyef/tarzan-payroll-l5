@extends('layouts.app')
@section('content')
<div class="container">

	<div class="page-header">
		<h1>Create new Employee</h1>
	</div>
	<form method="POST" action="/employees" >
		{{csrf_field()}}
		<div class="row">

			{{-- 
				First Column 
			--}}
			<div class="col-md-6">

				<div class="row">
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('tarzan_id') ? ' has-error' : '' }}">
							<label for="tarzan_id" class="control-label">Tarzan ID</label>
							<input class="form-control" name="tarzan_id" placeholder="XX000" type="text" id="tarzan_id" value="{{old('tarzan_id', $employee->tarzan_id)}}">
							<small class="text-danger">{{ $errors->first('tarzan_id') }}</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('tema_sorting_id') ? ' has-error' : '' }}">
							<label for="tema_sorting_id" class="control-label">Tema Sorting Id</label>
							<input class="form-control" name="tema_sorting_id" type="text" id="tema_sorting_id" value="{{old('tema_sorting_id', $employee->tema_sorting_id)}}">
							<small class="text-danger">{{ $errors->first('tema_sorting_id') }}</small>
						</div>
					</div>
				</div>
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="control-label">Name</label>
					<input class="form-control" name="name" type="text" id="name" value="{{old('name', $employee->name)}}">
					<small class="text-danger">{{ $errors->first('name') }}</small>
				</div>
				<div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
					<label for="date_of_birth" class="control-label">Date of Birth</label>
					<input class="form-control" name="date_of_birth" type="text" placeholder="DD/MM/YYYY" id="date_of_birth" value="{{old('date_of_birth', $employee->date_of_birth)}}">
					<small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
				</div>
				<div class="form-group{{ $errors->has('date_joined') ? ' has-error' : '' }}">
					<label for="date_joined" class="control-label">Date Joined</label>
					<input class="form-control" name="date_joined" type="text" placeholder="DD/MM/YYYY" id="date_joined" value="{{old('date_joined', $employee->date_joined)}}">
					<small class="text-danger">{{ $errors->first('date_joined') }}</small>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="location">Location</label>
						<div class="form-group">
							<select class="form-control" name="location" id="location">
								<option @if((strstr($employee->location, 'Accra Head Office') || @in_array('Accra Head Office', old('location')))) selected @endif>Accra Head Office</option>
								<option @if((strstr($employee->location, 'Blue Gallery Permanent') || @in_array('Blue Gallery Permanent', old('location')))) selected @endif>Blue Gallery Permanent</option>
								<option @if((strstr($employee->location, 'Container Depot (Tema)') || @in_array('Container Depot (Tema)', old('location')))) selected @endif>Container Depot (Tema)</option>
								<option @if((strstr($employee->location, 'Directors') || @in_array('Directors', old('location')))) selected @endif>Directors</option>
								<option @if((strstr($employee->location, 'Management') || @in_array('Management', old('location')))) selected @endif>Management</option>
								<option @if((strstr($employee->location, 'Tema Admin') || @in_array('Tema Admin', old('location')))) selected @endif>Tema Admin</option>
								<option @if((strstr($employee->location, 'Tema Permanent') || @in_array('Tema Permanent', old('location')))) selected @endif>Tema Permanent</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
							<label for="designation" class="control-label">Designation</label>
							<input class="form-control" name="designation" type="text" id="designation" value="{{old('designation', $employee->designation)}}">
							<small class="text-danger">{{ $errors->first('designation') }}</small>
						</div>
					</div>
				</div>

				<div class="form-group{{ $errors->has('basic_pay') ? ' has-error' : '' }}">
					<label for="basic_pay" class="control-label">Basic Pay</label>
					<input class="form-control" name="basic_pay" type="text" id="basic_pay" value="{{old('basic_pay', $employee->basic_pay)}}">
					<small class="text-danger">{{ $errors->first('basic_pay') }}</small>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group{{ $errors->has('element_car') ? ' has-error' : '' }}">
							<label for="element_car" class="control-label">Car Element</label>
							<input class="form-control" name="element_car" type="text" id="element_car" value="{{old('element_car', $employee->element_car)}}">
							<small class="text-danger">{{ $errors->first('element_car') }}</small>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group{{ $errors->has('element_rent') ? ' has-error' : '' }}">
							<label for="element_rent" class="control-label">Rent Element</label>
							<input class="form-control" name="element_rent" type="text" id="element_rent" value="{{old('element_rent', $employee->element_rent)}}">
							<small class="text-danger">{{ $errors->first('element_rent') }}</small>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group{{ $errors->has('element_other') ? ' has-error' : '' }}">
							<label for="element_other" class="control-label">Other Elements</label>
							<input class="form-control" name="element_other" type="text" id="element_other" value="{{old('element_other', $employee->element_other)}}">
							<small class="text-danger">{{ $errors->first('element_other') }}</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="union">Member of Union?</label>
						<div class="form-group">
							<select class="form-control" name="union" id="union">
								<option @if($employee->union == 0 || old('union') == 0) selected @endif value="0">No</option>
								<option @if($employee->union == 1 || old('union') == 1) selected @endif value="1">Yes</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="wife">Has Wife?</label>
						<div class="form-group">
							<select class="form-control" name="wife" id="wife">
								<option @if($employee->wife == 0 || old('wife') == 0) selected @endif value="0">No</option>
								<option @if($employee->wife == 1 || old('wife') == 1) selected @endif value="1">Yes</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group{{ $errors->has('children') ? ' has-error' : '' }}">
							<label for="children" class="control-label">Children</label>
							<input class="form-control" name="children" type="text" id="children" placeholder="0" value="{{old('children', $employee->children)}}">
							<small class="text-danger">{{ $errors->first('children') }}</small>
						</div>
					</div>
				</div>

			</div>

			{{-- 

				Second Column 

			--}}


			<div class="col-md-6">
				<div class="row">
					<div class="col-md-4">
						<label for="contributes_to_ssf">Contributes to SSF?</label>
						<div class="form-group">
							<select class="form-control" name="contributes_to_ssf" id="contributes_to_ssf">
								<option @if($employee->contributes_to_ssf == 0 || old('contributes_to_ssf') == 0) selected @endif value="0">No</option>
								<option @if($employee->contributes_to_ssf == 1 || old('contributes_to_ssf') == 1) selected @endif value="1">Yes</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="disabled">Is Disabled?</label>
						<div class="form-group">
							<select class="form-control" name="disabled" id="disabled">
								<option @if($employee->disabled == 0 || old('disabled') == 0) selected @endif value="0">No</option>
								<option @if($employee->disabled == 1 || old('disabled') == 1) selected @endif value="1">Yes</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="soap">Gets Soap Allowance?</label>
						<div class="form-group">
							<select class="form-control" name="soap" id="soap">
								<option @if($employee->soap == 0 || old('soap') == 0) selected @endif value="0">No</option>
								<option @if($employee->soap == 1 || old('soap') == 1) selected @endif value="1">Yes</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="mode_of_payment">Method of Payment</label>
						<div class="form-group">
							<select class="form-control" name="mode_of_payment" id="mode_of_payment">
								<?php $options = \App\Lists::get('mode_of_payment'); ?>
								@foreach($options as $option)
									<option @if((strstr($employee->mode_of_payment, $option) || @in_array($option, old('mode_of_payment')))) selected @endif>{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="bank_name">Name of Bank</label>
						<div class="form-group">
							<select class="form-control" name="bank_name" id="bank_name">
								{{-- Null option first --}}
								<?php $options = \App\Lists::get('bank_name'); ?>
								@foreach($options as $option)
									@if(empty($option))
										<option value=null>None</option>
									@else
										<option @if((strstr($employee->bank_name, $option) || @in_array($option, old('bank_name')))) selected @endif >{{$option}}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group{{ $errors->has('bank_account_number') ? ' has-error' : '' }}">
							<label for="bank_account_number" class="control-label">Bank Account No</label>
							<input class="form-control" name="bank_account_number" placeholder="optional" type="text" id="bank_account_number" value="{{old('bank_account_number', $employee->bank_account_number)}}">
							<small class="text-danger">{{ $errors->first('bank_account_number') }}</small>
						</div>
					</div>
				</div>

			</div>
		</div>
		<input type="submit" class="btn btn-primary"></input>
	</form>
</div>
@stop

{{-- 

xxx            $table->increments('id');
xxx            $table->char('tarzan_id',5)->unique();
xxx            $table->unsignedSmallInteger('tema_sorting_id');
xxx            $table->string('name');
xxx            $table->dateTime('date_of_birth')->nullable();
xxx            $table->dateTime('date_joined')->nullable();
xxx            $table->string('location');
xxx            $table->string('designation');
xxx            $table->decimal('basic_pay',8,2);
000            $table->unsignedTinyInteger('days_absent')->default(0);
xxx            $table->decimal('element_car',8,2)->default(0.00);
xxx            $table->decimal('element_rent',8,2)->default(0.00);
xxx            $table->decimal('element_other',8,2)->default(0.00);
xxx            $table->boolean('union')->default(1);
xxx            $table->boolean('wife')->default(1);
xxx            $table->unsignedTinyInteger('children')->default(2);
xxx            $table->boolean('contributes_to_ssf')->default(1);
xxx            $table->boolean('disabled')->default(0);
xxx            $table->boolean('soap')->default(0);
xxx            $table->string('mode_of_payment')->default('cheque');
xxx            $table->string('bank_name')->nullable();
xxx            $table->string('bank_account_number')->nullable();
            $table->string('residence')->nullable();
            $table->string('house_number')->nullable();
            $table->string('contact_number')->nullable();
            $table->decimal('advance_amount',8,2)->default(0.00);
            $table->decimal('other_additions', 8,2)->default(0.00);
            $table->string('other_additions_description')->nullable();
            $table->decimal('other_deductions', 8,2)->default(0.00);
            $table->string('other_deductions_description')->nullable();
            $table->timestamps();




 --}}