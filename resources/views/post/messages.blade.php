<link rel="stylesheet" href="{{ asset('css/style1.css') }}">
<body>
    <h1>Сообщения</h1>
    <div class="message-container">
        @php
            $dialogues = [];
        @endphp

        @foreach($messages as $message)
            @php
                $isUnique = true;
                if ($message->receiver_id == session('user_id')) {
                    $dialogueId = $message->sender_id;
                } else {
                    $dialogueId = $message->receiver_id;
                }
                
                foreach ($dialogues as $key => $existingDialogue) {
                    if ($existingDialogue->sender_id == $dialogueId || $existingDialogue->receiver_id == $dialogueId) {
                        $isUnique = false;
                        if ($existingDialogue->created_at < $message->created_at) {
                            $dialogues[$key] = $message;
                        }
                        break;
                    }
                }

                if ($isUnique) {
                    $dialogues[] = $message;
                }
            @endphp
        @endforeach

        @foreach($dialogues as $dialogue)
            @php
                if ($dialogue->receiver_id == session('user_id')) {
                    $name = $dialogue->sender->name;
                    $userId = $dialogue->sender_id;
                } else {
                    $name = $dialogue->receiver->name;
                    $userId = $dialogue->receiver_id;
                }
            @endphp
            <div class="dialogue-card">
                <div class="dialogue-avatar" onclick="showUserProfile({{ $userId }})" data-user-id="{{ $userId }}"><img src="{{ asset('images/' . ($dialogue->receiver_id == session('user_id') ? $dialogue->sender->images : $dialogue->receiver->images)) }}" alt="User Image">
</div>
                <div class="dialogue-content" onclick="showDialog({{ $userId }})" data-user-id="{{ $userId }}"> 
                    <div class="dialogue-info">
                        <div class="dialogue-name">{{ $name }}</div>
                        <div class="dialogue-time">{{ $dialogue->created_at->format('d F H:i') }}</div>
                    </div>
                    <div class="dialogue-message">{{ $dialogue->sender->name }}: {{ $dialogue->text }}</div>
                </div>
            </div>
        @endforeach
    </div>
</body>

