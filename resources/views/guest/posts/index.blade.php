@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="card my-4">
                <div class="card-header">
                    <h2>{{$post->title}}</h2>
                </div>
                <div class="card-body">
                    <img src="{{asset('storage/'.$post->image)}}" alt="" style="width: 300px">
                    <h5 class="card-title my-4">{{$post->user->name}}</h5>
                    <p class="card-text">{{substr($post->body_content,0,300).'...'}}</p>
                    <p>{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
                    <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">Read</a>
                </div>
            </div>  
        @endforeach
    </div>
@endsection