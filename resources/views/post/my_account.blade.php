<link rel="stylesheet" href="{{ asset('css/style1.css') }}"> 
<body>
    <h1>Мой аккаунт</h1>
    <div class="profileImage"> 
        <img src="{{ asset('images/' . $user->images) }}"  alt="User Image">
    </div>
    <div id="userData">
        <p>Name: {{ $user->name }}</p>
        <p>Surname: {{ $user->surname }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Age: {{ $user->age }}</p>
    </div>
    <button id="editButton" onclick="editMode()"><img src="/images/Редактировать.png" width="20" height="20"></button><br>

    <form id="editForm" style="display: none;">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="{{ $user->surname }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>
        <div>
            <label for="age">Age:</label>
            <input type="number" name="age" value="{{ $user->age }}">
        </div>
        <button type="button" onclick="saveChanges('{{ $user->id }}')"><img src="/images/Сохранить.png" width="20" height="20"></button>
    </form>
    <script src="script.js"></script>
</body>

