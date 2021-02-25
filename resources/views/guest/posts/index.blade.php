@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-header">
                    <h2>{{$post->title}}</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$post->user->name}}</h5>
                    <p class="card-text">{{substr($post->body_content,0,300).'...'}}</p>
                    <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">Read</a>
                </div>
            </div>  
        @endforeach
    </div>
@endsection