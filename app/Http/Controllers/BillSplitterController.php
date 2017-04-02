<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillSplitterController extends Controller
{
    // main routine for displaying Split the Check calculator
    public function index(Request $request) {

	if (($request->has('act') and $request->input('act') == 'reset')) {
	   $totalBill = 0;
	   $numPeople = 1;
	   $tip = 'good';
	   $roundUp = '';

	   return view('index')->with([
             'totalBill' => $totalBill,
             'numPeople' => $numPeople,
             'tip'       => $tip,
             'roundUp'   => $roundUp,
	   ]);
	} 


        // storage array for how much to tip depending on the quality of service
        static $serviceType = [                             
   		    "poor" => 0.10,
		    "good" => 0.15,
		    "great"=> 0.20,
	  	  ];

        $ppBill = 0;
        $errors = '';


        $totalBill = $request->input('totalBill', 0);
        $numPeople = $request->input('numPeople', 1);

	$tip = $request->input('tip', 'good');

	if ($request->has('roundUp'))
	   $roundUp = 'CHECKED';
	else
	   $roundUp = '';

        if (($request->has('act') and $request->input('act') == 'calculate')) {
	    $service = $serviceType[$tip];  

	    // calculate bill per person with tip
            $ppBill = ($totalBill+ ($totalBill * $service)) / $numPeople;

            // round up to whole dollar amount, if requested
	    if ($roundUp == 'CHECKED')
                $ppBill = ceil($ppBill);

	    // format bill per person in USD notation
            $ppBill = number_format($ppBill, 2, ".", "");

	}

        return view('index')->with([
	     'totalBill' => $totalBill,
	     'numPeople' => $numPeople,
	     'tip'       => $tip,
	     'roundUp'   => $roundUp,
	     'ppBill'    => $ppBill,
	     'errors'    => $errors,
	]);
    }


}
