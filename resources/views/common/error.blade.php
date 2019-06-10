@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>不可為空!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
