<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checker</title>
    </head>
    <body>
        <h1>Messages for {{ $phoneLine->number }}</h1>
        <h3>
            <a href="{{ route('home') }}">Back</a>
        </h3>
        <table>
            <th>From</th>
            <th>Message</th>
            <th>Time</th>
            @foreach ($phoneLine->messages as $message)
                <tr>
                    <td>{{ $message->from }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->date }}</td>
                </tr>
            @endforeach
        </table>
      
    </body>
</html>
