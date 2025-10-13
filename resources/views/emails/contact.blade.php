<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e0e0e0;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .message-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            max-width: 700px;
            width: 100%;
            line-height: 1.6;
            word-wrap: break-word;
            border: 1px solid #d1d1d1;
        }

        .message-container p {
            margin: 15px 0;
            font-size: 16px;
            color: #333333;
        }

        .message-container a {
            color: #1a73e8;
            text-decoration: none;
        }

        .message-container a:hover {
            text-decoration: underline;
        }

        .rtl {
            direction: rtl;
            text-align: right;
        }

        .ltr {
            direction: ltr;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="message-container">
        @foreach (explode("\n", $data['message']) as $line)
            <p class="{{ preg_match('/\p{Arabic}/u', $line) ? 'rtl' : 'ltr' }}">
                {!! e($line) !!}
            </p>
        @endforeach
    </div>
</body>
</html>
