<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    
    public function resource()
    {
    	$resource = Resource::with('locations')->get();
    	return view('pages,resource', compact('resource'));
    }
}
