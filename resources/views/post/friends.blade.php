<h1>Поиск</h1>
<div class="search-container">
    <input type="text" id="friend-search" placeholder="Поиск друзей...">
    <button onclick="searchFriends()">Поиск</button>
</div>
<div id="friend-results" class="friend-results-container">
@foreach ($users as $user)
    @if ($user->id !== session('user_id'))
        <div class="friend-card">
            <div class="friend-avatar" onclick="showUserProfile('{{ $user->id }}')"><img src="{{ asset('images/' . $user->images) }}" alt="User Image"></div>
            <div class="friend-details">
                <div class="friend-name">{{ $user->name }} {{ $user->surname }}</div>
                <div class="friend-actions">
                        @if ($user->isFriend)
                            <button onclick="removeFromFriends('{{ $user->id }}')"><img src="/images/Удалить.png" width="20" height="20"></button>
                        @elseif ($user->friendRequestSent)
                            <button onclick="cancelFriendRequest('{{ $user->id }}')"><img src="/images/Отменить.png" width="20" height="20"></button>
                        @else
                            <button onclick="addToFriend('{{ $user->id }}')"><img src="/images/Добавить.png" width="20" height="20"></button>
                        @endif
                    <button onclick="showDialog({{ $user->id }})"><img src="/images/Написать.png" width="20" height="20"></button>
                </div>
            </div>
        </div>
    @endif
@endforeach


