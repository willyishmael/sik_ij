<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <form action="/login" method="POST">
        @csrf
        <label for="email">Email Address</label><br>
        <input type="email" name="email" class="form-control" id="email" autofocus required><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" class="form-control" id="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

