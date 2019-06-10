@extends('layouts.app')

@section('content')
<div class="container">
    <div class="navbar-text">
        <h1>
            {{Auth::user()->name}}

            <small>registered {{ Auth::user()->created_at->diffForHumans()}}</small>
        </h1>
    </div>
<HR>
    @foreach ($messages as $message)
        <div class="panel panel-default" style = "border:1px solid #bfd1eb;background:#f3faff">
            <div class="navbar-text" >
                <a href="#">{{ Auth::user()->name }}</a> posted:
                <a href = "{{ url('message/'.$message->id . '/notes') }}">
                    {{ $message->content }}
                </a>
                {{ $message->created_at->diffForHumans() }}
            </div>
            <div class="panel-body">


            </div>
        </div>

    @endforeach
    <br>
{{$messages->links()}}
</div>


@endsection
