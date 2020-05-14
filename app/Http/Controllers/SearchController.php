<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function newPeople()
	{
		$users = User::orderBy('created_at', 'desc')->take(8)->get();

		return $users;
	}

    public function people($query)
    {
    	$results = User::where('name', 'LIKE', '%'.$query.'%')->get();

    	if($results->isEmpty()){
    		$results = User::where('last_name', 'LIKE', '%'.$query.'%')->get();
    	}

    	return $results;
    }
}
