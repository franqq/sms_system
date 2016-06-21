<?php

class MemberController extends BaseController {

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
	
	public function addNew()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'First_Name'				=>'required|max:50',
				'Second_Name'				=>'required|max:50',
				'Email'					    =>'email',
				'Phone_Number'				=>'required|max:12',
				'National_ID'				=>'max:8',

		));
		
		if($validator->fails())
		{
			return Redirect::route('addmember-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			$firstname = Input::get('First_Name');
			$secondname = Input::get('Second_Name');
			$email = Input::get('Email');
			$phone_number = Input::get('Phone_Number');
			$national_id = Input::get('National_ID');
			$group_id = Input::get('Group');
						
 
			 
			 //register the new user
			 $user		= Member::create(array(
			 				'firstname'		=>$firstname,
			 				'lastname'		=>$secondname,
							'email'			=>$email,
							'phone_number'		=>$phone_number,
							'national_id'		=>$national_id,
							'active'		=>TRUE,
			 ));
			 
			 if($user)
			 {

			 	$savegroup = Membergroup::create(array(
			 		'group_id'=>$group_id,
			 		'member_id'=>$user->id
			 	));

			 	if($savegroup)
			 	{

				return Redirect::route('addmember-get')
					->with('global','Success! '.$firstname. ' has been added.');
				}	
			 }
			
		}

		return Redirect::route('addmember-get')
					->with('global','Failed! Please try again.');
		
	}

	public function editMember()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'First_Name'				=>'required|max:50',
				'Second_Name'				=>'required|max:50',
				'Email'					    =>'email',
				'Phone_Number'				=>'required|max:12',
				'National_ID'				=>'max:8',
				'Group'                     =>'',

		));
		
		if($validator->fails())
		{
			return Redirect::route('addmember-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			$memberId  = Input::get('memberID');
			$firstname = Input::get('First_Name');
			$secondname = Input::get('Second_Name');
			$email = Input::get('Email');
			$phone_number = Input::get('Phone_Number');
			$national_id = Input::get('National_ID');
						
 			$member_edit = Member::where('id','=',$memberId)->first();

 			$member_edit->firstname = $firstname;
 			$member_edit->lastname = $secondname;
 			$member_edit->email = $email;
 			$member_edit->phone_number = $phone_number;
 			$member_edit->national_id = $national_id;

 			$membersave = $member_edit->save();
			 
			 if($membersave)
			 {
				return Redirect::route('viewmember-get')
					->with('global','Success! '.$firstname.'\'s have been updated.');	
			 }
			
		}
		
	}

	public function deleteMember()
	{
		
		
			$memberId  = Input::get('memberID');
			
						
 			$member_delete = Member::where('id','=',$memberId)->first();
 			$member_delete->active = FALSE;

 			$member_delete = $member_delete->save();
			 
			 if($member_delete)
			 {
				return Redirect::route('viewmember-get')
					->with('global','Success! Member information has been deleted successfully.');	
			 }	
	}
		
}
