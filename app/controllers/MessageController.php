<?php
include_once(app_path().'/includes/AfricasTalkingGateway.php');



class MessageController extends BaseController {

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

	public function SendSms($my_recipient,$my_message)
		{
			// Specify your login credentials
			$username   = "adback";
			$apikey     = "c933c719506a6838d4ceac95c9411b27331f34a117ca80473529d967ff9c46b0";
			
			// Specify the numbers that you want to send to in a comma-separated list
			// Please ensure you include the country code (+254 for Kenya in this case)
			$recipients = $my_recipient;
			
			// And of course we want our recipients to know what we really do
			$message    = $my_message;
			
			// Create a new instance of our awesome gateway class
			$gateway    = new AfricasTalkingGateway($username, $apikey);
			
			// Any gateway errors will be captured by our custom Exception class below, 
			// so wrap the call in a try-catch block
			try 
			{ 
			  // Thats it, hit send and we'll take care of the rest. 
			  $results = $gateway->sendMessage($recipients, $message);
			  if($results) {
			    return TRUE;
			  }
			  else {
				  return FALSE;
			  }
			}
			catch ( AfricasTalkingGatewayException $e )
			{
			  return FALSE;
			}
			
			// DONE!!! 
		}
	
	public function postSendMessage()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Phone_Number'				=>'required',
				'Message'				=>'required',

		));
		
		if($validator->fails())
		{
			return Redirect::route('sendmessage-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			$phonenumbers = Input::get('Phone_Number');
			$message = Input::get('Message');
			
			
			//remove white spaces from the numbers
			$compressedphonenumbers = str_replace(' ','', $phonenumbers);

			//get the specific phone numbers from the array
 			$phonenumbers_array = explode(',', $compressedphonenumbers);

 			$cost_incurred = sizeof($phonenumbers_array) * $this->cost($message);



 			$owner = Owner::where('id','=',1)->first();
			$ownerid = $owner->owner_id;

			$balance = DB::select('select balance from clients.balance where id= ?', array($ownerid));
			$current_balance = end($balance)->balance;

			if($cost_incurred<=$current_balance)
			{

 			$allsent = FALSE;
 			$messagesent = FALSE;
 			$todaysdate 	  = date("Y-m-d");



 			foreach($phonenumbers_array as &$phonenumber)
 			{
			 //register the new user
			 $user		= Message::create(array(
			 				'phone_number'		=>$phonenumber,
			 				'message'		=>$message,
			 				'date'			=>$todaysdate,
			 				'cost'			=>$this->cost($message),
			 				'active'        =>TRUE
			 ));

			 $phone_number_send = '+254'.substr($phonenumber, strlen($phonenumber)-9);

			$messagesent = $this->SendSms($phone_number_send, $message);
			 
			if($messagesent==TRUE)
			 {
				$allsent = TRUE;
			 }
			 
			}



			if($allsent==TRUE)
			 {
			 	$newbalance = $current_balance - $cost_incurred;



			 	$updatebalance = DB::update('update clients.balance set balance= ? where id= ?', array($newbalance,$ownerid));

				return Redirect::route('sendmessage-get')
					->with('global','Success! Your message has been sent');	
			 }

			}
			else
			{
				return Redirect::route('sendmessage-get')
					->with('global','Sorry, your current balance is insufficient.')->withInput();
			}
		}
		
	}

	public function postSendMessageToAll()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
			'Message'				=>'required',

		));
		
		if($validator->fails())
		{
			return Redirect::route('sendmessagetoall-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			
			$message = Input::get('Message');

			 
			//get the members information
			$members = Member::where('active','=',TRUE)->get();

			$cost_incurred = $members->count() * $this->cost($message);
			$owner = Owner::where('id','=',1)->first();
			$ownerid = $owner->owner_id;

			$balance = DB::select('select balance from clients.balance where id= ?', array($ownerid));
			$current_balance = end($balance)->balance;

			if($cost_incurred<=$current_balance)
			{
			
			$sent = FALSE;
			$todaysdate 	  = date("Y-m-d");
			
			foreach($members as $member){
				 //register the new user
			 $user		= Message::create(array(
			 				'phone_number'		=>$member->phone_number,
			 				'message'			=>$message,
			 				'member_id'			=>$member->id,
			 				'cost'				=>$this->cost($message),
			 				'date'			    =>$todaysdate,
			 				'active'            =>TRUE
			 ));


			   $phone_number_send = '+254'.substr($member->phone_number, strlen($member->phone_number)-9);
			   $sent = $this->SendSms($phone_number_send, $message);
			}
			
			 
			 if($sent==TRUE)
			 {

			 	$newbalance = $current_balance - $cost_incurred;



			 	$updatebalance = DB::update('update clients.balance set balance= ? where id= ?', array($newbalance,$ownerid));
				return Redirect::route('sendmessagetoall-get')
					->with('global','Success! Your message has been sent');	
			 }
			}
			else
			{
				return Redirect::route('sendmessagetoall-get')
					->with('global','Sorry, your current balance is insufficient.')->withInput();
			}
			
		}
		
	}

		public function postSendMessageToGroup()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
			'Message'				=>'required',
		));
		
		if($validator->fails())
		{
			return Redirect::route('sendmessagetogroup-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			
			$message = Input::get('Message');
			$groupid = Input::get('Group');

			$members = Membergroup::where('group_id','=',$groupid)->with(array(
							'Member'=>function($q){
								$q->where('active','=',TRUE);
							}
						))->get();


			$cost_incurred = $members->count() * $this->cost($message);
			$owner = Owner::where('id','=',1)->first();
			$ownerid = $owner->owner_id;

			$balance = DB::select('select balance from clients.balance where id= ?', array($ownerid));
			$current_balance = end($balance)->balance;

			if($cost_incurred<=$current_balance)
			{
			
			$sent = FALSE;
			$todaysdate 	  = date("Y-m-d");
			
			foreach($members as $member){
				 //register the new user
			 $user		= Message::create(array(
			 				'phone_number'		=>$member->Member()->first()->phone_number,
			 				'message'			=>$message,
			 				'member_id'			=>$member->Member()->first()->id,
			 				'cost'				=>$this->cost($message),
			 				'date'			    =>$todaysdate,
			 				'active'            =>TRUE
			 ));


			   $phone_number_send = '+254'.substr($member->Member()->first()->phone_number, strlen($member->Member()->first()->phone_number)-9);
			   $sent = $this->SendSms($phone_number_send, $message);
			}
			
			 
			 if($sent==TRUE)
			 {

			 	$newbalance = $current_balance - $cost_incurred;



			 	$updatebalance = DB::update('update clients.balance set balance= ? where id= ?', array($newbalance,$ownerid));
				return Redirect::route('sendmessagetogroup-get')
					->with('global','Success! Your message has been sent');	
			 }
			}
			else
			{
				return Redirect::route('sendmessagetogroup-get')
					->with('global','Sorry, your current balance is insufficient.')->withInput();
			}
			
		}
		
	}
	
	
	public function postDeleteMessage()
	{
		
		
			$messageId  = Input::get('messageID');
			
						
 			$message_delete = Message::where('id','=',$messageId)->first();
 			$message_delete->active = FALSE;

 			$message_delete = $message_delete->save();
			 
			 if($message_delete)
			 {
				return Redirect::route('sentmessage-get')
					->with('global','Success! Message information has been deleted successfully.');	
			 }	
	}
		
		public function cost($textmessage){
             return ceil(strlen($textmessage)/160)*2;
		}

		public function postSendToManySend()
	{
		
		
			$checkboxdata_array = Input::get('checkbox');

			if($checkboxdata_array==NULL)
				return Redirect::route('sendmessagetomany-get')->with('global','Please Select at Least One Member');
			
			$checkboxdata = implode(',', $checkboxdata_array);

			View::share('phonenumbers',$checkboxdata);

			return View::make('members.sendtomanysend');				
 			
	}
}
