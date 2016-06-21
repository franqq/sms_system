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
            <a href="#">Members</a>
        </li>
        <li>
            <a href="#">View</a>
        </li>
    </ul>
</div>

<div style ="text-align:center;"> 
                    @if(Session::has('global'))
                    <div style="color:#990000;">{{Session::get('global')}}</div>
                    @endif
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-user"></i> Groups</h2>

              
            </div>
           <div class="box-content">
     <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
  <th>Name</th>
       
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
    <tr>

        <td>{{$group->name}}</td>
        
        <td class="center">
            <a class="btn btn-success" data-toggle="modal" data-target="#myModal{{$group->id}}" href="#">
               
                <i class="glyphicon glyphicon-plus icon-white"></i>
              
                Add Members
              
            </a>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">View Details</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" action="{{URL::route('addmembertogroup-post')}}" method="post">

        <div style="height:450px;overflow:scroll;">
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive ">
    <thead>
    <tr>
      <th><input type="checkbox" id="checkAll" > All</th>
  <th>National ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone number</th>

        <th>Email</th>
    </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
    <tr>
        <td><input type="checkbox" value="{{$member->id}}"  class="chk" name="checkbox[]" ></td>
        <td>{{$member->national_id}}</td>
        <td class="center">{{$member->firstname}}</td>
        <td class="center">{{$member->lastname}}</td>
        <td class="center">{{$member->phone_number}}</td>
        <td class="center">{{$member->email}}</td>
    </tr>
    @endforeach
    <script type="text/javascript">
              $('#checkAll').change(function(){
           $('.chk').prop('checked',this.checked);
           });

        $(".chk").change(function () {
            if ($(".chk:checked").length == $(".chk").length) {
             $('#checkAll').prop('checked','checked');
            }else{
              $('#checkAll').prop('checked',false);  
            }
            });

    </script>

    </tbody>
    </table>
  </div>
  {{Form::token()}}


      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <input type="hidden" value="{{$group->id}}" name="GroupID" />
      </form>
    </div>
  </div>
</div>

<!--view members of a group -->

 <a class="btn btn-success" data-toggle="modal" data-target="#myModalX{{$group->id}}" href="#">
               
                <i class="glyphicon glyphicon-search icon-white"></i>
              
               View Members
              
            </a>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModalX{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">View Details</h4>
      </div>
      <div class="modal-body">
        <div style="height:450px;overflow:scroll;">
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive ">
    <thead>
    <tr>
      
  <th>National ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone number</th>

        <th>Email</th>
    </tr>
    </thead>
    <tbody>
        @foreach($group->Membergroup()->get() as $groupx)
    <tr>
       
        <td>{{$groupx->Member()->first()->national_id}}</td>
        <td class="center">{{$groupx->Member()->first()->firstname}}</td>
        <td class="center">{{$groupx->Member()->first()->lastname}}</td>
        <td class="center">{{$groupx->Member()->first()->phone_number}}</td>
        <td class="center">{{$groupx->Member()->first()->email}}</td>
    </tr>
    @endforeach


    </tbody>
    </table>
  </div>

      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

            <a class="btn btn-info" data-toggle="modal" data-target="#mysecondModal{{$group->id}}"  href="#">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <!-- Modal -->
<div class="modal fade" id="mysecondModal{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" role="form" action="{{URL::route('editgroup-post')}}" method="post">
  <div class="form-group">
    
   <label for="inputfirstname" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10" style="margin-bottom:15px;">
      <input type="text" class="form-control" id="inputfirstname" name="Name" required="required" placeholder="Enter the first name*"
      value="{{$group->name}}" />
    </div>
     @if($errors->has('Name'))
              <div style="color:#990000; text-align:center;">{{$errors->first('Name')}}</div>
     @endif
    
   <label for="inputcomment" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10" style="margin-bottom:15px;">
    <textarea class="form-control" rows="5" id="inputmessage"  name="Comment" required="required" placeholder="Type a comment in here.....*">{{$group->comment}}</textarea>
    </div>
     @if($errors->has('Comment'))
              <div style="color:#990000; text-align:center;">{{$errors->first('Comment')}}</div>
     @endif

  </div>
 
 <input type="hidden" name="groupID" value="{{$group->id}}">
 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    </div>
  </div>
  {{Form::token()}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
            <a class="btn btn-danger"  data-toggle="modal" data-target="#mydeleteModal{{$group->id}}" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>

<!-- Modal -->
<div class="modal fade" id="mydeleteModal{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"> Confirm Delete</h4>
      </div>
      <div class="modal-body">
       Are You Sure You Sure You Want To Delete?
       <form id="deleteinfo" action="{{URL::route('deletegroup-post')}}" method="post">
        <input type="hidden" id="groupID" name="groupID" value="{{$group->id}}">
        {{Form::token()}}
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
       </form>
    </div>
  </div>
</div>
        </td>
    </tr>
    @endforeach
    
    </tbody>
    </table>
     </div>
        </div>
    </div>
</div>


    <!--/span-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

@include('members.layout.footer')
