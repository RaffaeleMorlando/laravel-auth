@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-capitalize">id</th>
                    <th class="text-capitalize">title</th>
                    <th class="text-capitalize">author</th>
                    <th class="text-capitalize">preview image</th>
                    <th class="text-capitalize" style="width: 300px;">preview text</th>
                    <th class="text-capitalize">created</th>
                    <th class="text-capitalize">updated</th>
                    <th class="text-capitalize" colspan="2">Actions</th>
                    {{-- <th class="text-capitalize" colspan="2"></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{  $post->id  }}</td>
                        <td><a href="{{ route('admin.posts.show', $post->id) }}">{{  $post->title  }}</a></td>
                        <td>{{  $post->user->name  }}</td>
                        <td><img src="{{asset('storage/'.$post->image)}}" alt="" style="width: 100px;"></td>
                        <td>{{  substr($post->body_content,0,50).'...'  }}</td>
                        <td>{{  $post->created_at  }}</td>
                        <td>{{  $post->updated_at  }}</td>
                        <td class="text-center"><a href="{{ route('admin.posts.edit', $post->id)}}" class="btn btn-secondary"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center">
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection