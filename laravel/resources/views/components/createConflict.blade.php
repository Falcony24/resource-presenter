<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj konflikt</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <h1>Dodaj nowy konflikt</h1>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('conflicts.store') }}" method="POST">
        @csrf

        <label for="name">Nazwa konfliktu</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="link">Link (np. Wikipedia)</label>
        <input type="text" name="link" id="link" value="{{ old('link') }}">

        <label for="start_date">Data rozpoczęcia</label>
        <input type="text" name="start_date" id="start_date" placeholder="RRRR-MM-DD" value="{{ old('start_date') }}">

        <label for="end_date">Data zakończenia</label>
        <input type="text" name="end_date" id="end_date" placeholder="RRRR-MM-DD" value="{{ old('end_date') }}">

        <label for="casualties">Ofiary śmiertelne</label>
        <input type="text" name="casualties" id="casualties" value="{{ old('casualties') }}">

        <button type="submit">Dodaj konflikt</button>
    </form>
</body>
</html>
