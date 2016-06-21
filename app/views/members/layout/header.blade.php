<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> <div class="hidden-xs" >{{HTML::image('img/logo20.png')}}</div>
                <span>VentiSMS</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">{{Auth::user()->firstname}}</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                   
                    <li><a href="{{URL::route('account-logout')}}">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
          
            <!-- theme selector ends -->

        

        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="{{URL::route('home-get')}}"><i class="glyphicon glyphicon-home"></i> Home</a>                        </li>
						 
                         <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Members</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::route('addmember-get')}}">Add new</a></li>
                                <li><a href="{{URL::route('viewmember-get')}}">View members</a></li>
							
                            </ul>
                        </li>

                           <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span>Groups</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::route('addgroup-get')}}">Create New</a></li>
                                <li><a href="{{URL::route('viewgroup-get')}}">View Groups</a></li>
                            
                            </ul>
                        </li>

						 <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Messages</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::route('sendmessage-get')}}">Send</a></li>
                                <li><a href="{{URL::route('sendmessagetomany-get')}}">Send To Many</a></li>
								<li><a href="{{URL::route('sendmessagetoall-get')}}">Send To All</a></li>
                                <li><a href="{{URL::route('sendmessagetogroup-get')}}">Send To Group</a></li>
                                <li><a href="{{URL::route('sentmessage-get')}}">Sent Messages</a></li>
                            </ul>
                        </li>
						
                        
                        <li><a class="ajax-link" href="{{URL::route('sendemail-get')}}"><i
                                    class="glyphicon glyphicon-edit"></i><span> Email</span></a></li>
                        <li><a class="ajax-link" href="{{URL::route('reports-get')}}"><i class="glyphicon glyphicon-list-alt"></i><span> Reports</span></a>
                        </li>

                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Settings</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::route('changepassword-get')}}">Change Password</a></li>
                                @if(Auth::user()->admin == TRUE)<li><a href="{{URL::route('newuser-get')}}">New User</a></li>@endif
                                 @if(Auth::user()->admin == TRUE)<li><a href="{{URL::route('viewusers-get')}}">View Users</a></li>@endif
                              
                             
                            
                            </ul>
                        </li>


						<li><a href="{{URL::route('account-logout')}}"><i class="glyphicon glyphicon-lock"></i><span> Logout</span></a>
                        </li>    
                    </ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>
