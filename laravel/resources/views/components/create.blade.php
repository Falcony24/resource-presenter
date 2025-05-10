<!-- resources/views/commodities/create.blade.php -->
<x-layouts.main>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dodaj Surowiec</title>
        
        <!-- Link to your custom CSS file -->
        <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    </head>
    <body>
        <h1>Dodaj Nowy Surowiec</h1>

        <!-- Back Link in the Top-Right Corner -->
        <a href="{{ route('commodities') }}" style="position: absolute; top: 20px; right: 1600px">
            <img src="{{ asset('img/back.png') }}" alt="Powrót" style="width: 32px; height: 32px;">
        </a>

        <form action="{{ route('commodities.store') }}" method="POST">
            @csrf
            <label for="name">Nazwa Surowca:</label>
            <input type="text" id="name" name="name" required>
            <br><br>

            <label for="description">Opis:</label>
            <textarea id="description" name="description" required></textarea>
            <br><br>

            <button type="submit">Zapisz Surowiec</button>
        </form>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </body>
    </html>
</x-layouts.main>
