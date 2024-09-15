<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Post; // добавили

class AboutController extends Controller
{
	public function index()
	{
		return view('about');
	}
}
