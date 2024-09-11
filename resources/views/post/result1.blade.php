@if ($name !== 'no')
    <div class="success-message">
        <h2>Добро пожаловать, {{ $name }}!</h2>
        <p>Ваш пароль: {{ $password }}</p>
    </div>
@else
    <div class="error-message">
        <h2>Ошибка</h2>
        <p>Что-то пошло не так. Попробуйте еще раз.</p>
    </div>
@endif