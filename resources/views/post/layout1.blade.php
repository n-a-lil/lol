<title>Социальная сеть</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
<body>
<header class="header">
    @if(session('message'))
        <div class="success-message">{{ session('message') }}</div>
    @elseif(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif
    <div id="form-container">
        <button onclick="showLoginForm()">Войти</button>
        <button onclick="showRegistrationForm()">Зарегистрироваться</button>
    </div>
</header>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

