@if($name == 'no')
    <div class="error-message">
        <h2>Ошибка</h2>
        <p>Что-то пошло не так. Попробуйте еще раз.</p>
    </div>
@else
    <div class="success-message">
        <h2>{{ $name }}</h2>
        <p>{{ $surname }}</p>
        <p>{{ $email }}</p>
        <p>{{ $age }}</p>
    </div>
@endif