
@extends('welcome')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Type</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary"data-toggle="modal" data-target="#categorymodal" >+ Add New</button>
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
                            <h3 class="card-title">ALl Type list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th>Type Name</th>
                            <th>Icon</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($type as $key=>$row)
                              <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$row->type_name}}</td>
                                <td><img src="{{asset($row->icon)}}" height="32" width="50"/>
                                </td>
                                <td><a href="#"id="edittype"class=" btn btn-info btn-sm "data-id="{{$row->id}}"data-toggle="modal" data-target="#typemodal"><i class="fas fa-edit"></i></a>
                                <a href="{{route('type.delete',$row->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
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


<!-- Modal  for Add new category-->
<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add.type')}}"method="Post"enctype="multipart/form-data"id="add-form" >
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="type_name">Type Name</label>
                    <input type="text" class="form-control" id="type_name" name="type_name" required>
                </div>
              <div class="form-group">
                <label for="type_name">Icon</label>
                <input type="file" class="form-control dropify"name="icon">
          
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
  <div class="modal fade" id="typemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body"></div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript">
  
    $('body').on("click","#edittype", function(){
        let childcat_id = $(this).data('id');
        // alert(childcat_id);
        $.get("type/edit"+childcat_id, function(data){
            $("#modal_body").html(data);
        });
      });
  
  </script>
  

@endsection