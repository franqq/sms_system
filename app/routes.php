<?php

Route::group(array('before'=>'guest'),function(){ 
//home route	
Route::get('/',array(
	'as' => 'login-get',
	'uses' => 'NavigateController@getLogin'
));

//get forgot password
Route::get('/recover',array(
	'as' => 'passwordforgot-get',
	'uses' => 'AccountController@getPasswordRecovery'
));

//
Route::get('/reset/{code}',array(
	'as' => 'passwordreset-get',
	'uses' => 'AccountController@getResetPassword'
));


/*
* CSRF protection
* */
Route::group(array('before' => 'csrf'),function()
{
	Route::post('/dashboard',array(
		'as' => 'login-post',
		'uses' => 'AccountController@logIn'
	));
    
    //post recover email
	Route::post('/recover',array(
		'as' => 'passwordforgot-post',
		'uses' => 'AccountController@postForgotPassword'
	));

	//post password form
	Route::post('/reset',array(
		'as' => 'passwordreset-post',
		'uses' => 'AccountController@postResetPassword'
	));



});

});

Route::group(array('before'=>'auth'),function(){ 
	//get route to home
	Route::get('/home',array(
		'as'=> 'home-get',
		'uses'=>'NavigateController@getHome'
	));
	
	//get route to add member
	Route::get('/member/add',array(
		'as'=> 'addmember-get',
		'uses'=>'NavigateController@getAddMember'
	));
	
	//get route to view members
	Route::get('/member/view',array(
		'as'=> 'viewmember-get',
		'uses'=>'NavigateController@getViewMember'
	));

	//get route to creage new group
   Route::get('/group/create',array(
		'as'=> 'addgroup-get',
		'uses'=>'NavigateController@getCreateGroup'
	));

   	//get route to view groups
	Route::get('/group/view',array(
		'as'=> 'viewgroup-get',
		'uses'=>'NavigateController@getViewGroup'
	));

	
	//get route to  send message
	Route::get('/message/send',array(
		'as'=> 'sendmessage-get',
		'uses'=>'NavigateController@getSendMessage'
	));
	
	//get route to send message to all
	Route::get('/message/sendtoall',array(
		'as'=> 'sendmessagetoall-get',
		'uses'=>'NavigateController@getSendMessageToAll'
	));

	//get route to send to selected
	Route::get('/message/sendtomany',array(
		'as'=> 'sendmessagetomany-get',
		'uses'=>'NavigateController@getSendToMany'
	));
	
	//get route to send message to group
	Route::get('/message/sendtogroup',array(
		'as'=> 'sendmessagetogroup-get',
		'uses'=>'NavigateController@getSendMessageToGroup'
	));


	//get route to view message
	Route::get('/message/sent',array(
		'as'=> 'sentmessage-get',
		'uses'=>'NavigateController@getSentMessage'
	));
	
	//get route to send email
	Route::get('/email/send',array(
		'as'=> 'sendemail-get',
		'uses'=>'NavigateController@getSendEmail'
	));
	
	//get route to reports
	Route::get('/reports',array(
		'as'=> 'reports-get',
		'uses'=>'NavigateController@getReports'
	));

	//get route to change password
	Route::get('/changepassword',array(
		'as'=> 'changepassword-get',
		'uses'=>'AccountController@getChangePassword'
	));

	//get route to create user
	Route::get('/newuser',array(
		'as'=> 'newuser-get',
		'uses'=>'AccountController@getAddNewUser'
	));

	//get users
	Route::get('/viewusers',array(
		'as'=> 'viewusers-get',
		'uses'=>'AccountController@getViewUsers'
	));
	
	//get route to login user
	Route::get('/logout',array(
		'as'=> 'account-logout',
		'uses'=>'AccountController@logOut'
	));
	
	Route::group(array('before' => 'csrf'),function()
{
	Route::post('/member/add',array(
		'as' => 'addmember-post',
		'uses' => 'MemberController@addNew'
	));

	Route::post('/member/edit',array(
		'as' => 'editmember-post',
		'uses' => 'MemberController@editMember'
	));

	Route::post('/member/delete',array(
		'as' => 'deletemember-post',
		'uses' => 'MemberController@deleteMember'
	));
 
     Route::post('/group/create',array(
		'as' => 'addgroup-post',
		'uses' => 'GroupController@createNew'
	));

     Route::post('/group/edit',array(
		'as' => 'editgroup-post',
		'uses' => 'GroupController@editGroup'
	));

     //route to add members to a group
     Route::post('/membergroup/add',array(
		'as' => 'addmembertogroup-post',
		'uses' => 'GroupController@addtoGroupNew'
	));

     Route::post('/group/delete',array(
		'as' => 'deletegroup-post',
		'uses' => 'GroupController@deleteGroup'
	));
 


    Route::post('/message/send',array(
		'as'=> 'sendmessage-post',
		'uses'=>'MessageController@postSendMessage'
	));
	
	Route::post('/message/sendtoall',array(
		'as'=> 'sendmessagetoall-post',
		'uses'=>'MessageController@postSendMessageToAll'
	));

	//post route to send to group

	Route::post('/message/sendtogroup',array(
		'as'=> 'sendmessagetogroup-post',
		'uses'=>'MessageController@postSendMessageToGroup'
	));
    
    
    // post send to many
    Route::post('/message/sendtomany',array(
		'as'=> 'sendmessagetomany-post',
		'uses'=>'MessageController@postSendToManySend'
	));

	
	 Route::post('/message/delete',array(
		'as'=> 'deletemessage-post',
		'uses'=>'MessageController@postDeleteMessage'
	));
	//post route to reports
	Route::post('/reports',array(
		'as'=> 'reports-post',
		'uses'=>'ReportController@postGenerateReport'
	));

   //post change password
	Route::post('/changepassword',array(
		'as'=> 'changepassword-post',
		'uses'=>'AccountController@postChangePassword'
	));

	//post add new user
	Route::post('/newuser',array(
		'as'=> 'newuser-post',
		'uses'=>'AccountController@postAddNewUser'
	));

	//edit user
	Route::post('/user/edit',array(
		'as' => 'edituser-post',
		'uses' => 'AccountController@editUser'
	));

	//delete user
	Route::post('/user/delete',array(
		'as' => 'deleteuser-post',
		'uses' => 'AccountController@deleteUser'
	));



});
	
});
