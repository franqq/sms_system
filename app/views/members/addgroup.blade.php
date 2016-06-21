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
            <a href="#"> Groups</a>
        </li>
		<li>
            <a href="#">Create New</a>
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-edit"></i> Create New</h2>

              
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                  <div style ="text-align:center;"> 
                    @if(Session::has('global'))
                    <div style="color:#990000;">{{Session::get('global')}}</div>
                    @endif
            </div>
                   <form class="form-horizontal" role="form" action="{{URL::route('addgroup-post')}}" method="post">
  <div class="form-group">
    
   <label for="inputgroupname" class="col-sm-2 control-label">Group Name</label>
    <div class="col-sm-10" style="margin-bottom:15px;">
      <input type="text" class="form-control" id="inputgroupname" name="Name" required="required" placeholder="Enter the group name*"
      e{{(Input::old('Name')) ? ' value ='.Input::old('Name'). '' : ''}} />
    </div>
     @if($errors->has('Name'))
              <div style="color:#990000; text-align:center;">{{$errors->first('Name')}}</div>
     @endif
	
	 <label for="inputcomment" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10" style="margin-bottom:15px;">
    <textarea class="form-control" rows="5" id="inputmessage"  name="Comment" required="required" placeholder="Type a comment in here.....*">@if(Input::old('Comment')){{Input::old('Comment')}}@endif</textarea>
    </div>
     @if($errors->has('Comment'))
              <div style="color:#990000; text-align:center;">{{$errors->first('Comment')}}</div>
     @endif
  </div>
 
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
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
