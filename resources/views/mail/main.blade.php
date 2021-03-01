<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $post->title }}</title>
</head>
<body>
    <header>
        <h1>{{ $post->title }}</h1>
    </header>
    <main>
        <span>Author: {{ $post->user->name }}</span>
        <img src="{{ asset('storage/'.$post->image) }}" alt="" style="width: 100%">
        <p>{{ $post->body_content }}</p>
        
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read Post</a>
    </main>
    <footer>
        
    </footer>
</body>
</html>