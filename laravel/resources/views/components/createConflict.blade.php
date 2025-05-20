<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj konflikt</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

    <form action="{{ route('createConflict.create') }}" method="POST">
        @csrf

        <label for="name">Nazwa konfliktu</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="link">Link (np. Wikipedia)</label>
        <input type="text" pattern="https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)" name="link" id="link" value="{{ old('link') }}">

        <div class="row_3_cols">
            <div>
                <label for="start_date">Data rozpoczęcia</label>
                <input type="date" name="start_date" id="start_date" placeholder="RRRR-MM-DD" value="{{ old('start_date') }}">
            </div>

            <div>
                <label for="end_date">Data zakończenia</label>
                <input type="date" name="end_date" id="end_date" placeholder="RRRR-MM-DD" value="{{ old('end_date') }}">
            </div>

            <div>
                <label for="casualties">Ofiary śmiertelne</label>
                <input type="number" min="0" step="1" name="casualties" id="casualties" value="{{ old('casualties') }}">
            </div>
        </div>

        <label for="countries">Kraje zaangażowane (oddzielone znakiem ";")</label>
        <input type="text" name="countries" id="countries" value="{{ old('link') }}">

        <button type="submit">Dodaj konflikt</button>
    </form>
</body>
</html>
