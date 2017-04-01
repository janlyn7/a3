<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillSplitterController extends Controller
{

    // main routine for displaying Split the Check calculator
    public function index(Request $request) {
        dump($request);
        return view('index');
    }


}
