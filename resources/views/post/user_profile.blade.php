<link rel="stylesheet" href="{{ asset('css/style1.css') }}">
</head>
<body>
    <div class="user-profile">
        <h1>{{ $user->name }} {{ $user->surname }}</h1>
        <img src="{{ asset('images/' . $user->images) }}"  alt="User Image">
        <p>Email: {{ $user->email }}</p>
        <p>Age: {{ $user->age }}</p>
        @if($isFriend)
            <button onclick="removeFromFriend('{{ $user->id }}')"><img src="/images/Удалить.png" width="20" height="20"></button>
        @elseif($friendRequestSent)
            <button onclick="cancelFriendRequest('{{ $user->id }}')"><img src="/images/Отменить.png" width="20" height="20"></button>
        @else
            <button onclick="addToFriend('{{ $user->id }}')"><img src="/images/Добавить.png" width="20" height="20"></button>
        @endif
        <button onclick="showDialog('{{ $user->id }}')"><img src="/images/Написать.png" width="20" height="20"></button>
    </div>
</body>

