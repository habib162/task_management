
<form action="{{ route('task.update')}}"method="Post" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title"value="{{ $task->title }}" required>
        </div>
        <input type="hidden" class="form-control" name="id" value="{{ $task->id }}">
        <div class="form-group">
          <label for="due_date">Due Date</label>
          <input type="date" class="form-control" name="due_date"value="{{ $task->due_date }}"  required>
        </div>
        <div class="form-group">
          <label for="due_date">Due Time</label>
          <input type="time" class="form-control" name="time" value="{{ $task->start_time }}"  required>
        </div>
        <div class="form-group">
          <label for="duration">Duration</label>
          <input type="text" class="form-control" name="duration" placeholder="00:00" value="{{ $task->duration }}" required>
          <small id="emailHelp" class="form-text text-muted">This is Duration</small>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" name="type" required="">
                @foreach ($type as $row )
                    <option value="{{$row->id}}" 
                      @if ($row->id==$task->type_id)
                        selected=""
                    @endif>{{$row->type_name}}</option>
                @endforeach
            </select>
        </div>
      </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>