
@extends('layouts.app')

@section('content')

@include('common.error')
<h1 style="font-weight:bold;">laravel留言板</h1>
<div class="modal" id="createMessage" >
<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #3490dc">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;<span aria-hidden="true" class="ion-android-close"></span></button>
            </div>            <!-- Modal Body -->
            <div class="modal-body">
                <form class = "form-horizontal" action="/message" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <!-- <h4 class="modal-title" id="myModalLabel" style="color: black;">請輸入留言內容</h4> -->
                        <div>
                            <label for="inputContent" class="col-sm-2 control-label">Title</label>
                            <input type="text" name="title" >
                        </div>
                            <br>
                        <div style="display:flex;">
                            <label for="inputContent" class="col-sm-2 control-label">Content</label>
                            <textarea name="content" class="form-control" rows="3"></textarea>
                        </div>
                    </div>


                    <div class=" form-group modal-body">
                        <div class="form-group modal-footer" id="modal_footer">
                            <!--<input id="btnSubmit" name="btnSubmit" value="Donate" class="btn btn-default-border-blk" type="submit">-->
                            <input type="submit" id ="btn-submit" class = "btn btn-primary" value="送出">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<button style = "float:right;" type="submit"  class="btn btn-primary" data-toggle="modal"  data-backdrop="true" data-keyboard="true" data-target="#createMessage">新增留言</button>
<!-- <form action="/message/add" method="get">

    <input style = "float:right;" class = "btn btn-primary" type="submit" value = '新增留言'>
    {{csrf_field()}}
</form> -->

<div id = "div_message" class="table-responsive" style="display:inline-block;">
    <?php $count = 0 ?>
    <table class = "table table-hover">
        <tr style = "background: #c8c8c8">
          <td>使用者</td>
          <td>標題</td>
          <td>內容</td>
          <td>回覆數</td>
          <td>留言時間</td>
          <td>最後編輯時間</td>
          <td>操作</td>
        </tr>
        @foreach ($messages as $message)
          @if (Auth::user()->id == $message->user_id)
          <tr>
              <td>{{$users[$count]->name}}</td>
              <td>{{$users[$count]->title}}</td>
              <td>
                  <a href="{{ url('message/'.$message->id . '/notes') }}">
                      <div>
                          {{ $message->content }}
                      </div>
                  </a>
              </td>
              <td>{{$note[$count]->total}}</td>
              <td>{{$message->created_at}}</td>
              <td>{{$message->updated_at}}</td>
              <td>
                  @if (Auth::user()->id == $message->user_id)
                  <form action="/message/{{$message -> id}}/edit" method="get">
                      {{csrf_field()}}
                      <input id = "btn-edit" class = "btn btn-warning" type="submit" value = '編輯'>
                  </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-edit" class = "btn btn-warning" type="submit" disabled = "disalbed" value = '編輯'>
                      </form>
                  @endif
                  @if (Auth::user() -> id == $message -> user_id)
                      <form action="/message/{{$message -> id}}" method="post">
                          {{csrf_field()}}
                          {{method_field('delete')}}
                          <input id = "btn-del" class = "btn btn-danger" type="submit"  value = '刪除'>
                      </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-del" class = "btn btn-danger" type="submit" disabled = "disalbed" value = '刪除'>
                      </form>
                  @endif
                </td>
          </tr>
          @endif
          <?php $count++ ?>
        @endforeach
    </table>
</div>

<div id = "div_message_all" class="table-responsive" style = "display:none">
    <?php $count = 0 ?>
    <table class = "table table-hover">
        <tr style = "background: #c8c8c8">
          <td>使用者</td>
          <td>標題</td>
          <td>內容</td>
          <td>回覆數</td>
          <td>留言時間</td>
          <td>最後編輯時間</td>
          <td>操作</td>
        </tr>
        @foreach ($messages as $message)
          <tr>
              <td>{{$users[$count]->name}}</td>
              <td>{{$users[$count]->title}}</td>
              <td>
                  <a href="{{ url('message/'.$message->id . '/notes') }}">
                      <div>
                          {{ $message->content }}
                      </div>
                  </a>
              </td>
              <td>{{$note[$count]->total}}</td>
              <td>{{$message->created_at}}</td>
              <td>{{$message->updated_at}}</td>
              <td>

                  @if (Auth::user()->id == $message->user_id)
                  <form action="/message/{{$message -> id}}/edit" method="get">
                      {{csrf_field()}}
                      <input id = "btn-edit" class = "btn btn-warning" type="submit" value = '編輯'>
                  </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-edit" class = "btn btn-warning" type="submit" disabled = "disalbed" value = '編輯'>
                      </form>
                  @endif
                  @if (Auth::user() -> id == $message -> user_id)
                      <form action="/message/{{$message -> id}}" method="post">
                          {{csrf_field()}}
                          {{method_field('delete')}}
                          <input id = "btn-del" class = "btn btn-danger" type="submit"  value = '刪除'>
                      </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-del" class = "btn btn-danger" type="submit" disabled = "disalbed" value = '刪除'>
                      </form>
                  @endif
                </td>
          </tr>
          <?php $count++ ?>
        @endforeach
    </table>
</div>
<button style="align: center;" type="submit" name = "submit" id = "btn_show" value = "show_all">顯示全部</button>
@endsection
<!-- class = "btn btn-danger" -->
