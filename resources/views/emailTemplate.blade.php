<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ticket Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .content {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    @php
        setlocale(LC_ALL, 'IND');
        \Carbon\Carbon::setLocale('id');
    @endphp
    <div class="container">

        <div class="content">
            <p>Dear Admin,</p>
            <p>There is a new ticket created by <strong>{{ $data['user_name'] }}</strong> on
                <strong>{{ $data['created_at']->isoFormat('HH:mm, D MMMM Y') }}</strong>.
            </p>

            <p>Ticket Details:</p>
            <ul>
                <li><strong>Title:</strong> {{ $data['title'] }}</li>
                <li><strong>Priority:</strong> {{ $data['priority'] }}</li>
                <li><strong>Status:</strong> {{ $data['status'] }}</li>
            </ul>

            <p>You can view the ticket by clicking the link below:</p>
            <a href="{{ $data['ticket_link'] }}" class="btn" style="color: #fff">View Ticket</a>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>

</html>
