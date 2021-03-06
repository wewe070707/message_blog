@extends('layouts.app')

@section('content')
@include('common.error')
<div class="container">
    <div class="navbar-text">
        <h1>
             {{ Auth::user()->name }}'s Profile
        </h1>
    </div>
    <!--
        For updating user image
    -->
    <div class="row">
       <div class="col-md-10 col-md-offset-1">
           <img src="/uploads/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
           <h2>
               {{Auth::user()->name}}
               <small>registered {{ Auth::user()->created_at->diffForHumans()}}</small>
           </h2>
           <form enctype="multipart/form-data" action="/profile" method="POST">
               <label>Update Profile Image</label>
               <br>
               <input type="file" name="avatar">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <br>
               <input style = "margin-top : 10px;" type="submit" class="btn btn-primary">
           </form>
       </div>
   </div>
<hr>
    @foreach ($messages as $message)
        <div id = "panel" class="" style = "">
            <div  id = "panel-top" style = " " >
                <span>{{ Auth::user()->name }}</span> posted:
                <a href = "{{ url('message/'. $message->id . '/notes') }}">
                    {{ $message -> title }}
                </a>
                <!--
                diffForHumans is used to transfer the time to human knowing type
                -->
                <span style="float:right">{{ $message -> created_at->diffForHumans() }}</span>
            </div>
            <div id = "panel-foot" class="panel-body">
                {{ $message -> content }}
            </div>
        </div>
        <br>
    @endforeach
    <br>

{{$messages->links()}}
</div>


@endsection
