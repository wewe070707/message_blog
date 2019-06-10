@extends('layouts.app')

@section('content')

@include('common.error')
<div  class="container">
    <form action = "/message/{{$message->id}}" method  = "POST" class="form-horizontal">
        {{csrf_field()}}
        {{method_field('PUT')}}
      <div class="form-group" class = "form-control" style = "display: flex;">
        <label for="inputTitle" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" value = "{{$message['title']}}">
        </div>
      </div>
      <div class="form-group" style = "display: flex;">
        <label for="inputContent" class="col-sm-2 control-label">Content</label>
        <div class="col-sm-10">
            <textarea name="content" class="form-control" rows="3">{{$message['content']}}</textarea>
        </div>
      </div>
      <div class=" form-group modal-body">
          <div class="form-group modal-footer" id="modal_footer">
              <!--<input id="btnSubmit" name="btnSubmit" value="Donate" class="btn btn-default-border-blk" type="submit">-->
              <input class = "btn btn-primary" type="submit" value="送出">
          </div>
      </div>
    </form>
</div>
@endsection
