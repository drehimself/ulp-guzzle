<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todos</title>
</head>
<body>
    @foreach ($todos as $todo)
        <div>{{ $todo['title'] }}</div>
    @endforeach
</body>
</html>
