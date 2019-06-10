@extends('layouts.app')

@section('content')
@include('common.error')

<form action="" method="post">
{{csrf_field()}}

<div class="form-group">
    <label for="message-name" class="col-sm-3">請輸入內容</label>
    <div>
        <input type="text" name="name" >
    </div>
</div>
    <input type="submit" id ="btn-submit" class = "btn btn-primary" value="送出">
</form>
@endsection
