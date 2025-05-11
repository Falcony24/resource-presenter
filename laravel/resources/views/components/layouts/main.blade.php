@props(['title' => 'conflicts', 'styleSheets' => [], 'scripts' => []])

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @foreach($styleSheets as $style)
        <link rel="stylesheet" href="{{ asset($style) }}">
    @endforeach
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @foreach($scripts as $script)
        <script src="{{ $script }}"></script>
    @endforeach
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
{{ $slot }}
<x-footer />
</body>
</html>
