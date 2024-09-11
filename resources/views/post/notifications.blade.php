<h1>Уведомления</h1>
<div id="notification-results" class="notification-results-container">
    @foreach ($notifications as $notification)
        <div class="notification-card">
            <div class="notification-avatar" onclick="showUserProfile('{{ $notification->sender->id }}')"><img src="{{ asset('images/' . $notification->sender->images) }}" alt="User Image"></div>
            <div class="notification-details">
                <div class="notification-sender">{{ $notification->sender->name }} {{ $notification->sender->surname }}</div>
                <div class="notification-actions">
                    <button onclick="addFriend('{{ $notification->sender->id }}')"><img src="/images/Добавить.png" width="20" height="20"></button>
                    <button onclick="rejectFriend('{{ $notification->id }}')"><img src="/images/Отменить.png" width="20" height="20"></button>
                </div>
            </div>
        </div>
    @endforeach
</div>