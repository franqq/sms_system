<?php

class ReportController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function postGenerateReport()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Start_Date'				=>'required',
				'End_Date'				=>'required',
		));
		if($validator->fails())
		{
			return Redirect::route('reports-get')
			->withErrors($validator)
			->withInput();
		}
		else {
				$startdate = date("Y-m-d",strtotime(Input::get('Start_Date')));
				$enddate =  date("Y-m-d",strtotime(Input::get('End_Date')));

			if($startdate<=$enddate)
			{				
				$totalmessages = Message::where('date','>=',$startdate)->where('date','<=',$enddate)->count();
				
				$cost = Message::where('date','>=',$startdate)->where('date','<=',$enddate)->sum('cost');

		        $owner = Owner::where('id','=',1)->first();
		        $ownerid = $owner->owner_id;

		        $balance = DB::select('select balance from clients.balance where id= ?', array($ownerid));

		        $bal = end($balance)->balance;

		        View::share('bal',$bal);

				View::share('cost',$cost);

				View::share('startdate',$startdate);
				View::share('enddate',$enddate);

		
				View::share('totalmessages',$totalmessages);
				return View::make('members.reportfeedback');
			}
			else{
				return Redirect::route('reports-get')->withInput()->with('global','Failed, Please Enter The Correct Date Formats');
			}


			}
	}

}
