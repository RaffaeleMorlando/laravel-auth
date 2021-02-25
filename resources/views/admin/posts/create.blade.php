@extends('layouts.app')

@section('content')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label class="text-capitalize" for="title">title</label>
                <input class="form-control" type="text" for="title" id="title" name="title" value="{{ old('title')}}" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label class="text-capitalize" for="body_content">Text</label>
                <textarea class="form-control" name="body_content" id="body_content" cols="30" rows="10" placeholder="Enter text">{{ old('body_content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>

    </div>
    
@endsection