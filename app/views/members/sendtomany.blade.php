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
            <a href="#">Messsage</a>
        </li>
        <li>
            <a href="#">Send To Many</a>
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
                <h2><i class="glyphicon glyphicon-user"></i> Members</h2>

              
            </div>
             
           <div class="box-content">
            <form class="form-horizontal" role="form" action="{{URL::route('sendmessagetomany-post')}}" method="post">
            
              <button type="submit" class="btn btn-primary" style="margin-left:90%;margin-bottom:5px;" >Submit</button>
     <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
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
        <td><input type="checkbox" value="{{$member->phone_number}}"  class="chk" name="checkbox[]" ></td>
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

    {{Form::token()}}

  </form>
     </div>
    
        </div>

    </div>
</div>


    <!--/span-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

@include('members.layout.footer')
