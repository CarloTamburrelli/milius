<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class Reader extends Controller
{
     public function index()
    {
        $resources = Resource::all();
        return view('index',['resources' => $resources]);
    }

    public function read($url_resource)
	{
		$resources = Resource::whereUrl($url_resource)->first();
		return view('read',['resources' => $resources]);
	}
}
