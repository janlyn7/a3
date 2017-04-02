<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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
        $errmsgs = null;

        $totalBill = $request->input('totalBill', 0);
        $numPeople = $request->input('numPeople', 1);
	if ($request->has('roundUp'))
	   $roundUp = 'CHECKED';
	else
	   $roundUp = '';
	$tip = $request->input('tip', 'good');


	$rules = array(
       	    'totalBill' => 'required|numeric|min:0|max:10000',
       	    'numPeople' => 'required|integer|min:1|max:20',
        );

	$validator = Validator::make($request->input(), $rules);

        // get the error messages from the validator
	if ($validator->fails()) {
            $errmsgs = $validator->messages();
	} else {
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
	}

        return view('index')->with([
	     'totalBill' => $totalBill,
	     'numPeople' => $numPeople,
	     'tip'       => $tip,
	     'roundUp'   => $roundUp,
	     'ppBill'    => $ppBill,
	     'errmsgs'   => $errmsgs,
	]);
    }


}
