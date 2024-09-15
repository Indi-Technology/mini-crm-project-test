<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Send Created Ticket</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css" integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.js" integrity="sha512-MdZwHb4u4qCy6kVoTLL8JxgPnARtbNCUIjTCihWcgWhCsLfDaQJib4+OV0O8IS+ea+3Xv/6pH3vYY4LWpU/gbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body style="font-family: 'Figtree', sans-serif; font-smoothing: antialiased; min-height: 100vh;">
        <div style="padding: 20px;">
            <h2 style="font-weight: bold; font-size: 1.25rem;">{{ $data['title'] }}</h2>
            <p style="margin-top: 1rem; font-weight: 500;">{!! $data['body'] !!}</p>
            <a href="{{ url('/admin/tickets/detail/' . $data['ticket_id']) }}" style="display: inline-block; padding: 1rem;  background-color: #1e293b; color: white; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                Go To Ticket
            </a>
        </div>
    </body>
</html>
