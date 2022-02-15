<form action="{{route('type.update')}}"method="Post"enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="type_name">Type Name</label>
            <input type="text" class="form-control" id="type_name" name="type_name"value="{{$type->type_name}}" required>
        </div>
        <input type="hidden" class="form-control" name="id"value="{{$type->id}}" >
      <div class="form-group">
        <label for="type_name">Icon</label>
        <input type="file" class="form-control"name="icon">
        <input type="hidden" class="form-control"name="old_icon"value="{{$type->icon}}">
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>