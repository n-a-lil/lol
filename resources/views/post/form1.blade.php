<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 1</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
</head>
<body>
    <form action="/result1" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Submit">
    </form>
</body>
</html>