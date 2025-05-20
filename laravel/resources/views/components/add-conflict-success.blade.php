<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj konflikt</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <h1>Pomyślnie dodano nowy konflikt</h1>

    <div class="main">
        <a class="simple_text_link" href="{{ route("home") }}"><button>Strona główna</button></a>
        <a class="simple_text_link" href="{{ route("createConflict") }}"><button>Dodaj kolejny</button></a>
    </div>
</body>
</html>
