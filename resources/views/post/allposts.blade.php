    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <title>Новости</title>
    <body class="post-body">
    <h1>Новости</h1>
    <button onclick="addPosts()">Добавить новость</button>
    <div id="posts-results" class="posts-container">
        <div>
            @foreach ($posts as $post)
                <div class="post" onclick="showPost({{ $post->id }})">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->text }}</p>
                    @if ($post->image)
                        <img src="{{ asset('images/'. $post->image) }}" alt="Post Image">
                    @endif
                    <p>{{ $post->created_at->format('d F H:i')}}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>

