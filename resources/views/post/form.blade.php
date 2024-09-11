<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
</head>
<body>
    <form action="/result" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="surname" placeholder="Surname">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="age" placeholder="Age">
        <input type="submit" value="Submit">
    </form>
</body>
</html>