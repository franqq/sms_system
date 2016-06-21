<?php

class NavigateController extends BaseController {

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
	
	public function getLogin()
	{
		return View::make('members.login');
	}

	public function getHome()
	{
		$total = Member::all()->count();
		View::share('total',$total);
		$todaysdate = date('Y-m-d');
		$allmessages = Message::all();
		$todaysmessages = Message::where('date','=',date("Y-m-d"))->count();
		$owner = Owner::where('id','=',1)->first();
		$ownerid = $owner->owner_id;

		$balance = DB::select('select balance from clients.balance where id= ?', array($ownerid));

		$bal = end($balance)->balance;

		$lasttopups = DB::select('select amount from clients.transactions'.$ownerid.' where id= ?', array($ownerid));

		$lasttopup = end($lasttopups)->amount;

		View::share('lasttopup',$lasttopup);

		View::share('balance',$bal);

		View::share('todaysmessages',$todaysmessages);
		return View::make('members.home');
	}
	public function getAddMember()
	{
		$groups = Group::where('active','=',TRUE)->get();
		View::share('groups',$groups);
		return View::make('members.addmember');
	}
	public function getViewMember()
	{
		
		$members = Member::where('active','=',TRUE)->get();
		View::share('members',$members);
		return View::make('members.viewmember');
	}
	public function getSendMessage()
	{
		return View::make('members.send');
	}
	public function getSendMessageToAll()
	{
		return View::make('members.sendtoall');
	}
	public function getSendMessageToGroup()
	{
		$groups= Group::where('active','=',TRUE)->get();
		View::share('groups',$groups);
		return View::make('members.sendtogroup');
	}
	public function getSentMessage()
	{
		$messages = Message::where('active','=',TRUE)->get();
		View::share('messages',$messages);
		return View::make('members.sentmessages');
	}
	
	public function getSendEmail()
	{
		return View::make('members.sendemail');
	}
	public function getReports()
	{
		return View::make('members.reports');
	}

	public function getSendToMany()
	{
		$members = Member::where('active','=',TRUE)->get();
		View::share('members',$members);
		return View::make('members.sendtomany');
	}

	public function getCreateGroup()
	{
		return View::make('members.addgroup');
	}
	
	public function getViewGroup()
	{
		
		$groups = Group::where('active','=',TRUE)->with(array('Membergroup'=>
				function($query){
					$query->with(array(
							'Member'=>function($q){
								$q->where('active','=',TRUE);
							}
						));
				})
			)->get();

		//return $groups->first()->Membergroup()->first()->Member()->first()->firstname ;
		
		View::share('groups',$groups);
		$members = Member::where('active','=',TRUE)->get();
		View::share('members',$members);
		return View::make('members.viewgroups');
	}
}
