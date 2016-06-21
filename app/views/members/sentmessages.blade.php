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
            <a href="#">Messages</a>
        </li>
        <li>
            <a href="#">Sent</a>
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
                <h2><i class="glyphicon glyphicon-envelope"></i> Sent Messages</h2>

              
            </div>
           <div class="box-content">
		 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
	<th>Date</th>
	<th>Destination</th>
        <th>Message</th>
        <th>Cost</th>
	<th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($messages as $message)
    <tr>
	<td class="center">{{date('j/m/Y    h:t',strtotime($message->created_at))}}</td>
        <td class="center">{{$message->phone_number}}</td>
        <td class="center"> {{$message->message}}</td>
        <td class="center">{{$message->cost}}</td>
	<td>Sent</td>
        <td class="center">
            <a class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$message->id}}" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
            <!-- Modal -->
<div class="modal fade" id="myModal{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Message</h4>
      </div>
      <div class="modal-body">
        Are You Sure You Want To Delete?
         <form id="deleteinfo" action="{{URL::route('deletemessage-post')}}" method="post">
        <input type="hidden" id="messageID" name="messageID" value="{{$message->id}}">
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