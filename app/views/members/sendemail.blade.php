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
            <a href="#"> Member</a>
        </li>
		<li>
            <a href="#">Create email</a>
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> Compose Email</h2>

              
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                   <form class="form-horizontal" role="form">
  <div class="form-group">
    
	
	 <label for="inputmobilenumber" class="col-sm-2 control-label">Email Address</label>
    <div class="col-sm-10" style="margin-bottom:25px;">
      <input type="email" class="form-control" id="inputemail" placeholder="Enter the email address*">
    </div>


   <label for="inputmobilenumber" class="col-sm-2 control-label">Subject</label>
    <div class="col-sm-10" style="margin-bottom:25px;">
      <input type="email" class="form-control" id="inputemail" placeholder="Enter the subject*">
    </div>
	
	
	
     <label for="inputidnumber" class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="5"id="inputmessage" placeholder="Type your  email message in here.....*"></textarea>
    </div>
  </div>
 
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Send</button>
    </div>
  </div>
</form>

                   
                </div>
               

            </div>
        </div>
    </div>
</div>


    <!--/span-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
@include('members.layout.footer')