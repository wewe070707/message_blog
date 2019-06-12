@extends('layouts.app')

@section('js')
<script type="text/javascript">
function add_Reply_num(choose){
    if(choose == 0){
        var action_src = "/message/" + row_message + "/notes";
        var your_form = document.getElementById('pop_reply');
        your_form.action = action_src ;
    }
    else{
        var action_src = "/message/" + row_message + "/notes";
        var your_form = document.getElementById('pop_reply_2');
        your_form.action = action_src ;
    }
}

$('body').on('click', 'button', function(event) {
    row_message = $(this).next('input').attr('value');
});

var token = '{{Session::token()}}';
var urlLike = '{{route('like')}}';

$('.like').on('click',function (event) {
    event.preventDefault();
    var message_id = event.target.parentNode.dataset['messageid'];
    // var message_id = $(this).closest('td');
    isLike = event.target.previousElementSibling == null;
    alert(message_id);
    console.log(message_id);
})

$.ajax({
    url: urlLike,
    data: {
        isLike: isLike,
        message_id: message_id,
        _token:token
    },
    type: "POST",
}).done(function () {
    alert('s');
})
</script>
@endsection
@section('content')

@include('common.error')
<h1 style = "margin-left:1em; text-a">留言板</h1>
<button style = "float:right;" type="submit"  class="btn btn-primary" data-toggle="modal"  data-backdrop="true" data-keyboard="true" data-target="#createMessage">新增留言</button>

<div id = "div_message" class="table-responsive" style="display:inline-block;" style = " background-color: antiquewhite;">
    <?php $count = 0 ?>

    <table class = "table table-hover">
        <tr style = "background: #c8c8c8">
          <td>使用者</td>
          <td>標題</td>
          <td>內容</td>
          <td>回覆數</td>
          <td></td>
          <td>留言時間</td>
          <td>最後編輯時間</td>
          <td>操作</td>
        </tr>
        @foreach ($messages as $message)
          @if (Auth::user()->id == $message->user_id)
          <tr data-messageid = "{{$message->id}}">
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
              <td data-messageid = "{{$message->id}}">
                  <a href ="#" class = "like">{{ Auth::user()->likes()->where('message_id',$message->id)->first() ? Auth::user()->likes()->where('message_id',$message->id)->first()->like ==1 ? 'You like':'Like':'like'}}</a> |
                  <a href ="#" class = "like">{{ Auth::user()->likes()->where('message_id',$message->id)->first() ? Auth::user()->likes()->where('message_id',$message->id)->first()->like ==0 ? 'You dont like':'Dislike':'Dislike'}}</a>
                  <input type="hidden" name = "{{$message->id}}" value = "{{$message->id}}"></td>
              <td>{{$message->created_at}}</td>
              <td>{{$message->updated_at}}</td>
              <td style = "display:inline-flex;">
                  <button style = "margin:10px;" type="submit"  class="btn btn-primary" data-toggle="modal"  data-backdrop="true" data-keyboard="true" data-target="#editMessage" >回覆</button>
                  <input type="hidden" name = "{{$message->id}}" value = "{{$message->id}}">
                  @if (Auth::user()->id == $message->user_id)
                  <form action="/message/{{$message -> id}}/edit" method="get">
                      {{csrf_field()}}
                      <input id = "btn-edit" class = "btn btn-warning"  type="submit" value = '編輯'>
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
                          <input id = "btn-del" class = "btn btn-danger"  type="submit" onclick="return confirm('確認刪除?')" value = '刪除'>
                      </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-del" class = "btn btn-danger"  type="submit" disabled = "disalbed" value = '刪除'>
                      </form>
                  @endif
                  <div class="modal" id="editMessage" >
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header" style="background: #3490dc">
                                  <h3 style = "color: #f8f9fa">Reply message</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fas fa-times"></i>
                                      <!-- <span aria-hidden="true" class="ion-android-close"></span> -->
                                  </button>
                              </div>
                              <!-- Modal Body -->
                              <div class="modal-body">
                                  <form id = "pop_reply" class = "form-horizontal"  method="post" onsubmit="add_Reply_num(0)">
                                      {{csrf_field()}}
                                      <div class="form-group">
                                          <div style="display:flex;">
                                              <label for="inputContent" class="col-sm-2 control-label">Content</label>
                                              <textarea name="reply_content" class="form-control" rows="3"></textarea>
                                          </div>
                                      </div>
                                      <div class=" form-group modal-body">
                                          <div class="form-group modal-footer" id="modal_footer">
                                              <input type="submit" id ="btn-submit" class = "btn btn-primary" value="送出">
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>

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
              <td style = "display:inline-flex;" data-messageid = "{{$message->id}}">
                  <button style = "margin:10px;" type="submit"  class="btn btn-primary" data-toggle="modal"  data-backdrop="true" data-keyboard="true" data-target="#editMessage_2" >回覆</button>
                  <input type="hidden" name = "{{$message->id}}" value = "{{$message->id}}">
                  @if (Auth::user()->id == $message->user_id)
                  <form action="/message/{{$message -> id}}/edit" method="get">
                      {{csrf_field()}}
                      <input id = "btn-edit" class = "btn btn-warning"  type="submit" value = '編輯'>
                  </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-edit" class = "btn btn-warning"  type="submit" disabled = "disalbed" value = '編輯'>
                      </form>
                  @endif
                  @if (Auth::user() -> id == $message -> user_id)
                      <form action="/message/{{$message -> id}}" method="post">
                          {{csrf_field()}}
                          {{method_field('delete')}}
                          <input id = "btn-del" class = "btn btn-danger"  type="submit" onclick="return confirm('確認刪除?')" value = '刪除'>
                      </form>
                  @else
                      <form action="" method="get">
                          {{csrf_field()}}
                          <input id = "btn-del" class = "btn btn-danger"  type="submit" disabled = "disalbed" value = '刪除'>
                      </form>
                  @endif
                  <!-- edit message popout -->
                  <div class="modal" id="editMessage_2" >
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header" style="background: #3490dc">
                                  {{$message->id}}
                                  <h3 style = "color: #f8f9fa">Reply message</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fas fa-times"></i>
                                      <!-- <span aria-hidden="true" class="ion-android-close"></span> -->
                                  </button>
                              </div>
                              <!-- Modal Body -->
                              <div class="modal-body">
                                  <form id = "pop_reply_2" class = "form-horizontal"  method="post" onsubmit="add_Reply_num(1)">
                                      {{csrf_field()}}
                                      <div class="form-group">
                                          <div style="display:flex;">
                                              <label for="inputContent" class="col-sm-2 control-label">Content</label>
                                              <textarea name="reply_content" class="form-control" rows="3"></textarea>
                                          </div>
                                      </div>
                                      <div class=" form-group modal-body">
                                          <div class="form-group modal-footer" id="modal_footer">
                                              <input type="submit" id ="btn-submit" class = "btn btn-primary" value="送出">
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                </td>
          </tr>
          <?php $count++ ?>
        @endforeach
    </table>
</div>

<div>
<button style="align: center;" type="submit" class="align-middle" name = "submit" id = "btn_show" value = "show_all">顯示全部</button>
</div>
<!-- create message popout -->
<div class="modal" id="createMessage" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #3490dc">
                <h3 style = "color: #f8f9fa">Create message</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                    <!-- <span aria-hidden="true" class="ion-android-close"></span> -->
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class = "form-horizontal" action="/message" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
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
                            <input type="submit" id ="btn-submit" class = "btn btn-primary" value="送出">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
