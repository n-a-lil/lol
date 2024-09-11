<h1>Выбранная новость</h1>

<div class="post">
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->text }}</p>
    @if ($post->image)
        <img src="{{ asset('images/'. $post->image) }}" alt="Post Image">
    @endif
    <p>{{ $post->created_at->format('d F H:i') }}</p>
</div>

<div class="like-section">
    <button onclick="likePost({{ $post->id }})"><img src="/images/heart.png" width="20" height="20"></button>
    <span id="like-count">{{ $post->likes()->count() }}</span>
</div>

<div class="comment-section">
    <h3>Добавить комментарий</h3>
    <textarea id="comment_text" name="comment_text" rows="3" cols="50"></textarea>
    <button type="button" onclick="addComment({{ $post->id }})">Отправить комментарий</button><br><br>
</div>

<div class="comments-list" style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
    @foreach($comments as $comment)
        <div>
            @if ($comment->user)
                {{ $comment->user->name }}:
            @else
                Аноним:
            @endif
            {{ $comment->comment_text }}
        </div>
    @endforeach
</div>
