@extends('layouts.app')

@section('js')
<script type="text/javascript">
//leave ajax notes
$(function() {
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$("#ajax").click(function() {
    $.ajax({
        url: "{{url("/message/" . $message->id  ."/notes")}}",
        data: {
            reply_content: $('#message-content').val()
        },
        type: "POST",
        dataType: 'json',
        success: function(msg) {
                $('#ajax-append').prepend("<div id = \"panel\" class=\"container\"> <br><div id = \"panel-top\">" +
                 msg[0]['name'] +"<span style=\"float:right\">"+ msg[0]['created_at'] +"</span></div><div id = \"panel-foot\"><span> " +
                 msg[0]['reply_content'] +"</span><i style = \"float:right; color:#4EA1DF\">於回覆</i></div><div class = \"modal-footer\"><form action=\"/message/" + {{$message -> id}} + "/notes/ method=\"post\">"
                  + "<input class = \"btn btn-danger\" type=\"submit\"  value = \"刪除\"></form></div></div></div>"
             );
            },
            error: function(xhr) {
                console.log("fail");
            },
            complete: function() {
            }
    });
    });
});
</script>





@endsection

@section('content')
@include('common.error')

<div class = "container">

    <div class = "container">
        <p></p>
        <h3 style="text-align:center;">留言內容</h3>
        @foreach( $notes as $note)
            @php
                $mes_notes = $note->user()->get()
            @endphp
            <div id = "ajax-append">
                </br>
                <div id = "panel" class="container">
                      <br>
                      <div id = "panel-top">
                          @foreach( $mes_notes as $mes_note)
                              {{$mes_note->name}}
                          @endforeach
                          <span style="float:right">{{ $note -> created_at->diffForHumans() }}</span>
                      </div>
                      <div id = "panel-foot">
                          <span>
                              {{ $note -> reply_content }}
                          </span>
                          <i style = "float:right; color:#4EA1DF">
                              於{{ $note -> created_at }}回覆
                          </i>
                      </div>
                      <div class = "modal-footer">
                          @if ( Auth::user()->id == $note->user_id )
                              <form action="/message/{{$message -> id}}/notes/{{$note -> id}}" method="post">
                                  {{csrf_field()}}
                                  {{method_field('delete')}}
                                  <input class = "btn btn-danger" type="submit"  value = '刪除'>
                              </form>
                          @else
                              <form>
                                    <input class = "btn btn-danger" type="submit"  value = '刪除' disabled = "disabled">
                              </form>
                          @endif
                      </div>
                  </div>
              </div>
            </br>
        @endforeach
    </div>
    <form action="{{ url( '/message/' . $message->id . '/notes')}}" method="post" style="text-align:center;">
    {{csrf_field()}}
        <label for="message-content">回覆此留言</label>
        <div>
            <input  type="text" align = "center" id = "message-content" name="reply_content" placeholder="請輸入內容" >
        </div>

        <input type="submit" id ="btn-submit" class = "btn btn-primary" value="送出">
    </form>
    <button id = 'ajax' class = 'btn btn-primary' style="float:right">
        <i class="fa fa-plus">Ajax留言</i>
    </button>
</div>
@endsection
