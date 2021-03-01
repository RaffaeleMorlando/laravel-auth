@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">{{$post->title}}</h1>
        <div class="info my-3">
            <h6><i class="fas fa-user"></i> Author: {{$post->user->name}}</h6>
            <span><i class="fas fa-calendar-alt"></i> {{$post->created_at->format('d-m-Y')}}</span>
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="width: 100%">
        </div>
        <p style="font-size: 1.3rem">{{$post->body_content}}</p>
    </div>
@endsection

