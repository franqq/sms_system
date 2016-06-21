@include('members.layout.head')
@include('members.layout.header')
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#"></a>
        </li>
    </ul>
</div>
     <div style ="text-align:center;"> 
                    @if(Session::has('global'))
                    <div style="color:#990000;">{{Session::get('global')}}</div>
                    @endif
    </div>

<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Members</div>
            <div>{{$total}}</div>
           
        </a>
    </div>
	  <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-envelope blue"></i>

            <div>Messages</div>
            <div>{{$balance/2}}</div>
         
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-star blue"></i>

            <div>Balance</div>
            <div>Ksh {{$balance}}</div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart blue"></i>

            <div>Last Top up</div>
            <div>Ksh {{$lasttopup}}</div>
         </a>
    </div>

  
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> VentiSMS</h2>

              
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h1>Its guaranteed to be read <br>
                    </h1>
                    <p>Phone calls can be ignored, TV ads can be skipped, newspaper ads can be jettisoned, online banner ads can be dismissed, but bulk SMS can't be ignored just like that.
                     A well-circulated statistics has it that 98% of all text messages are read within 5 minutes! </p>

                    <h1>Branded messages</h1>
                    <p>

Send text messages with the name of your organization across all networks in Kenya.</p>

                   
                </div>
               

            </div>
        </div>
    </div>
</div>


    <!--/span-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div>

@include('members.layout.footer')