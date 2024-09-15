<!DOCTYPE html>
<html>

<head>
    <title>New Ticket Created - {{ $ticket->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>New Ticket Created</h1>
        <p>A new ticket has been created.</p>
        <p><strong>Title:</strong> {{ $ticket->title }}</p>
        <p><strong>Description:</strong> {!! $ticket->description !!}</p>
        <a href="{{ route('tickets.show', $ticket) }}">View Ticket</a>
    </div>
</body>

</html>
