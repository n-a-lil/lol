<title>Социальная сеть</title>
<link rel="stylesheet" href="{{ asset('css/style1.css') }}"> 
<body>
    <header class="header">
        <div class="header-left">
                <img src="/images/заставка.png" width="450" height="150">
            <div class="notifications"></div>
        </div>
        
        <div class="header-right">
            @if(session('user_id') && isset($userName))
                <span>Привет, {{ $userName }}</span>
                <button onclick="logout()" class="login-link">Выход</button>
            @endif
        </div>
    </header>

    <div class="container">
        <aside class="left-sidebar">
            <ul class="sidebar-menu">
                <li><a href="#" class="sidebar-link" onclick="showMyAccount()">Мой аккаунт</a></li>
                <li><a href="#" class="sidebar-link" onclick="showMessages()">Сообщения</a></li>
                <li><a href="#" class="sidebar-link" onclick="showPosts()">Новости</a></li>
                <li>
                    <a href="#" class="sidebar-link">Друзья</a>
                    <ul>
                        <li><a href="#" class="sidebar-link" onclick="showAllFriends()">Найти друзей</a></li>
                        <li><a href="#" class="sidebar-link" onclick="showMyFriends()">Мои друзья</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sidebar-link" onclick="showNotifications()">Уведомления</a></li>
                <li><a href="#" class="sidebar-link">Музыка</a>
                <ul>
                        <li><a href="#" class="sidebar-link" onclick="showAllMusic()">Найти музыку</a></li>
                        <li><a href="#" class="sidebar-link" onclick="showMusic()">Моя музыка</a></li>
                </ul>
                </li>
            </ul>
        </aside>
        <main id="main-content" class="main-content">
            @if(session('message'))
                <div class="success-message">{{ session('message') }}</div>
            @elseif(session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif
        </main>
        <aside class="right-sidebar">
            <ul class="sidebar-menu">
            </ul>
        </aside>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

