
    <title>Добавить новость</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Добавить новость</h1>
        <div class="form-group">
            <label for="title" class="form-label">Заголовок:</label><br>
            <input type="text" id="title" name="title" class="form-input"><br>
        </div>
        <div class="form-group">
            <label for="text" class="form-label">Текст:</label><br>
            <textarea id="text" name="text" class="form-textarea"></textarea><br>
        </div>
        <div class="form-group">
            <label for="image" class="form-label">Изображение:</label><br>
            <input type="file" id="image" name="image" class="form-input"><br>
        </div>
        <button onclick="addPost()">Сохранить</button>
    </div>
</body>
