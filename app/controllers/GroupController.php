<?php

class GroupController extends BaseController {

	public function createNew(){
 			

		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Name'				=>'required|max:50',
				'Comment'				=>'required',
			

		));
		
		if($validator->fails())
		{
			return Redirect::route('addgroup-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			$groupname = Input::get('Name');
			$comment = Input::get('Comment');
		
						
 
			 
			 //register the new user
			 $group		= Group::create(array(
			 				'name'		=>$groupname,
			 				'comment'		=>$comment,
							'active'		=>TRUE,
			 ));
			 
			 if($group)
			 {
				return Redirect::route('addgroup-get')
					->with('global','Success! '.$groupname. ' has been added.');	
			 }
			
		}
		


	}



      public function deleteGroup()
      	{
		
		
			$groupId  = Input::get('groupID');
			
						
 			$group_delete = Group::where('id','=',$groupId)->first();
 			$group_delete->active = FALSE;

 			$group_delete = $group_delete->save();
			 
			 if($group_delete)
			 {
				return Redirect::route('viewgroup-get')
					->with('global','Success! Group information has been deleted successfully.');	
			 }	
	}
		
	
	public function editGroup()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Name'				=>'required|max:50',
				'Comment'				=>'required',
				

		));
		
		if($validator->fails())
		{
			return Redirect::route('addgroup-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			$groupId  = Input::get('groupID');
			$name = Input::get('Name');
			$comment = Input::get('Comment');
			
 			$group_edit = Group::where('id','=',$groupId)->first();

 			$group_edit->name = $name;
 			$group_edit->comment = $comment;
 			

 			$groupsave = $group_edit->save();
			 
			 if($groupsave)
			 {
				return Redirect::route('viewgroup-get')
					->with('global','Success! '.$name.'\'s have been updated.');	
			 }
			
		}
		
	}

	public function addtoGroupNew()
	{
		$checkboxdata_array = Input::get('checkbox');
		$groupid = Input::get('GroupID');

		if($checkboxdata_array==NULL)
			return Redirect::route('viewgroup-get')->with('global','Please Select at Least One Member');

		foreach ($checkboxdata_array as $data) {
				$members = Membergroup::where('group_id','=',$groupid)->where('member_id','=',$data);
				if(!$members->count())
				{
					Membergroup::create(array(
						'member_id' => $data,
						'group_id'  => $groupid
					));
				}
		}

		return Redirect::route('viewgroup-get')->with('global','Members have been successfully added to the group.');
			
	}

}
