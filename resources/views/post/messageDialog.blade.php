<link rel="stylesheet" href="{{ asset('css/style1.css') }}"> 
<body>
    <h1>Диалог c {{$user->name}}</h1>
    <div class="dialog-container">
        @foreach($messages as $message)
            <div class="dialogue-card">
                <div class="dialogue-avatar" onclick="
                    @if($message->sender->id == session('user_id'))
                        showMyAccount();
                    @else
                        showUserProfile('{{ $message->sender->id }}');
                    @endif
                "><img src="{{ asset('images/' . $message->sender->images) }}" alt="User Image"></div>
                <div class="dialogue-content">
                    <div class="dialogue-info">
                        <div class="dialogue-name">{{ $message->sender->name }}</div>
                        <div class="dialogue-time">{{ $message->created_at->format('d F H:i') }}</div>
                    </div>
                    <div class="dialogue-message">{{ $message->text }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <form id="message-form">
        <input type="text" id="message-text" placeholder="Введите сообщение">
        <button onclick="addMessage({{ $user->id }})">Отправить</button>
    </form>
</body>
