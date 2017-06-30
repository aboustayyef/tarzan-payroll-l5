<?php

/*

This Utility class returns a list of unique values in a field. 
Example: Lists::get('location') returns an Array of all possible locations.

*/

namespace App;

class Lists
{
	public static function get($field_name){
		try {
			return Employee::orderBy($field_name)->distinct()->get([$field_name])->pluck($field_name)->toArray();
		} catch (\Illuminate\Database\QueryException $e) {
			// in case $field_name is wrong and doesn't exist;
			return [];
		}
	}
}
