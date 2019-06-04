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
<!-- @include('common.error') -->

<form action="" method="post">
{{csrf_field()}}

<div class="form-group">
    <label for="message-name" class="col-sm-3">請輸入內容</label>
    <div class="col-sm-6">
        <input type="text" name="name" >
    </div>
</div>
    <input type="submit" id ="btn-submit" class = "btn-submit" value="送出">
</form>
@endsection
</body>
</html>
