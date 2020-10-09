<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checker</title>
    </head>
    <body>
        <ul>
            @foreach ($phoneLines as $phoneLine)
                <li>{{ $phoneLine->number }} | {{ $phoneLine->country }} | <a href="{{ route('web.messages', ['id' => $phoneLine->id]) }}">Messages</a> </li>
            @endforeach
        </ul>
      
    </body>
</html>
