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
            console.log(msg);
                console.log(msg[0]['user_id']);
                $('#ajax-append').append
                ("<div id = \"note_box\" class=\"container\">" + msg[0]['content'] + "</div>");
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

<div id="ajax-append" class = "container">
    <p style="text-align:center;">留言內容</p>
    @foreach( $notes as $note)
        @php
            $mes_notes = $note->user()->get()
        @endphp
        <div id = "note_box" class="container">
              <br>
              <p>
                  {{ $note -> reply_content }}
              </p>
              <span>
                    @foreach( $mes_notes as $mes_note)
                        {{$mes_note->name}}
                    @endforeach
                    於
                    {{ $note -> created_at }}
                    回復
              </span>
              @if ( Auth::user()->id == $message->user_id )
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
        </br>
    @endforeach

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
