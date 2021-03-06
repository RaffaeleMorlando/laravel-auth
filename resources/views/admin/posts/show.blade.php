@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">{{$post->title}}</h1>
        <a class="float-right btn btn-secondary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
        <div class="info my-3">
            <h6><i class="fas fa-user"></i> Author: {{$post->user->name}}</h6>
            <span><i class="fas fa-calendar-alt"></i> {{$post->created_at->format('d-m-Y')}}</span>
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="width: 100%">
        </div>
        <p class="">{{$post->body_content}}</p>
    </div>
@endsection