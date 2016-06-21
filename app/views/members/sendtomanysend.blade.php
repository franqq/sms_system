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
            <a href="#"> Message</a>
        </li>
		<li>
            <a href="#">Send To Many</a>
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-envelope"></i> Create Message</h2>

              
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
<div style ="text-align:center;"> 
                    @if(Session::has('global'))
                    <div style="color:#990000;">{{Session::get('global')}}</div>
                    @endif
</div>

                   <form class="form-horizontal" role="form"  action="{{URL::route('sendmessage-post')}}" method="post">
  <div class="form-group">
    
	
	 <label for="inputmobilenumber" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10" style="margin-bottom:15px;">
      <input type="text" class="form-control" disabled="disabled" name="Phone_Number"  placeholder="Enter the phone numbers and separate with a comma*"
      value="{{$phonenumbers}}" />
    </div>
     @if($errors->has('Phone_Number'))
              <div style="color:#990000; text-align:center;">{{$errors->first('Phone_Number')}}</div>
     @endif
	
	
	
     <label for="inputidnumber" class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="5" id="inputmessage"  name="Message" required="required" placeholder="Type your message in here.....*">@if(Input::old('Message')){{Input::old('Message')}}@endif</textarea>
    Auto-Calculator : Amount per text <strong style="color:#990000;"  ><strong id="printchatbox">loading...</strong></strong>

    <script type="text/javascript">
                      
                      var inputBox = document.getElementById('inputmessage');
        
                        inputBox.onkeyup = function(){
                       
                           calculated = Math.ceil(inputBox.value.length/160)*2;
                           if(calculated==0)
                            calculated=2;
                           
                             document.getElementById('printchatbox').innerHTML = 'KSH ' + calculated+'.00';
                        }
                    </script>

    </div>

  </div>
 
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Send</button>
    </div>
  </div>
  {{Form::token()}}
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