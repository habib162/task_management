@extends('welcome')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Task Manager</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('type.index')}}" class="btn btn-info" style="margin-right: 10px">+ add type</a>
              <button class="btn btn-primary"data-toggle="modal" data-target="#categorymodal" >+ Add New Task</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Task list</h3>   
                        </div>
                            <div class="form-group col-lg-3"style="margin: auto; margin-top:10px;">
                              <form action="{{route('task.filter')}}" method="POST">
                                @csrf
                                <label for="col-6"style="margin-left:100px;">Filter By Due Date</label>
                                <input class="form-control" name="fiterdate" type="date">
                                <button class="form-control btn btn-success">Filter</button>
                              </form>
                            </div>  
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm ytable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th> Title</th>
                            <th>Due Date</th>
                            <th>Duration</th>
                            <th>Type</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ( $data as $key=>$row ) 
                            <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$row->title}}</td>
                          
                            @if (date('	m / d / y ')<=date('	m / d / y ', strtotime($row->due_date)))
                             <td  style="color: red">{{date('	m / d / y ', strtotime($row->due_date)) }} at {{date('g:i a', strtotime($row->start_time))}}</td>
                            @else
                              <td >{{date('	m / d / y ', strtotime($row->due_date)) }} at {{date('g:i a', strtotime($row->start_time))}}</td>
                            @endif
                            <td>{{date('H:i', strtotime($row->duration)) }} </td>
                            <td><img src="{{asset($row->icon)}}" alt=""height="4%"width="4%"> {{$row->type_name}}</td>
                            <td>
                              <a href="#"id="edit_task" class=" btn btn-info btn-sm " data-id="{{ $row->id }}"  data-toggle="modal" data-target="#editmodal" ><i class="fas fa-edit"></i></a>
                              <a href="{{route('task.delete',$row->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                            </td>
                            </tr> 
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('create.task')}}"method="Post" id="add-form">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                  <label for="due_date">Due Date</label>
                  <input type="date" class="form-control" name="due_date" required>
                </div>
                <div class="form-group">
                  <label for="due_date">Time</label>
                  <input type="time" class="form-control" name="time" required>
                </div>
                <div class="form-group">
                  <label for="duration">Duration</label>
                  <input type="text" class="form-control" name="duration" placeholder="00:00" required>
                  <small id="emailHelp" class="form-text text-muted">This is Duration</small>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type" required="">
                        @foreach ($type as $row )
                            <option value="{{$row->id}}">{{$row->type_name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body">  
    
        </div>
      </div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

  $('body').on("click","#edit_task", function(){
      let task_id = $(this).data('id');
      //alert(subcat_id);
      $.get("task/edit"+task_id, function(data){
        $("#modal_body").html(data);
      });
  });


</script>


@endsection