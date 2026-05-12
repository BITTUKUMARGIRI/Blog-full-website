<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Enter title">
    <input type="file" name="video">
    <button type="submit">Upload</button>
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif


</form>