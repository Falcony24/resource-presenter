@props(['title' => 'conflicts', 'styleSheets' => []])

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @foreach($styleSheets as $style)
        <link rel="stylesheet" href="{{ asset($style) }}">
    @endforeach
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
{{ $slot }}
</body>
</html>
