<form action="/message/{{$message['id']}}" method="post">
    {{csrf_field()}}
    {{method_field('put')}}
    <p>
        <input type="text" name="name" value = "{{$message['name']}}">
    </p>
    <input type="submit" value="送出">
</form>
