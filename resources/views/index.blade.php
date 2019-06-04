<!DOCTYPE html>
<head>
<script type="text/javascript" src="{{URL::asset('js/submit.js')}}"></script>
<!-- <script src="https://developers.google.com/speed/libraries/?csw=1" type="text/javascript"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
</head>
<body>
@extends('layouts.app')

@section('content')
{{$users}}
@include('common.error')
<!-- {{$user = Auth::user()}} -->
<?php $count = 0 ?>
<h1>laravel 留言</h1>
<form action="/message/add" method="get">
    <input type="submit" value = '新增留言'>
    <br>
    {{csrf_field()}}
</form>
<!-- {{$messages}} -->
<div class="table-responsive">
    <table class = "table table-hover">
        <tr>
          <td>使用者</td>
          <td>內容</td>
        </tr>
        @foreach ($messages as $message)

          <tr>

          <td>{{$users[$count]->name}}</td>

          <td>
              <a href="{{ url('message/'.$message->id) }}">
                  <div>
                      {{ $message->name}}
                  </div>
              </a>
          </td>
          <!-- <br> -->

          <td>
              <form action="/message/{{$message -> id}}/edit" method="get">
                  {{csrf_field()}}
                  <input type="submit" value = '編輯'>
              </form>
              @if ($user -> id == $message -> user_id)
                  <form action="/message/{{$message -> id}}" method="post">
                      {{csrf_field()}}
                      {{method_field('delete')}}
                      <input type="submit"  value = '刪除'>
                  </form>
              @endif

            </td>
          </tr>
          <?php $count++ ?>
        @endforeach
    </table>
</div>
<!-- <button type="submit" name = "submit" value = "show_all"><a href="/message">顯示全部</a></button> -->
@endsection
</body>
</html>
<!-- class = "btn btn-danger" -->
