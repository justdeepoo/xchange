<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;


class TestController extends Controller {

    public function __construct(Request $request)
	{
    }

    public function test()
	{
        echo 'tESt';
        //return view('xchange/dashboard', []);
    }

    

}