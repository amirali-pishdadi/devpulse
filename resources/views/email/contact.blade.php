<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تماس با ما - پیامی جدید</title>
    <style>
        body {
            font-family: 'Vazir', Tahoma, Arial, sans-serif;
            background-color: #ffffff;
            color: #343a40;
            margin: 0;
            padding: 0;
            direction: rtl;
            text-align: right;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #dc3545;
        }
        .header {
            background-color: #dc3545;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            color: #343a40;
            margin-top: 0;
        }
        .footer {
            background-color: #f8f9fa;
            color: #6c757d;
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
        }
        .button {
            display: inline-block;
            background-color: #dc3545;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #f5c6cb;
            padding: 10px;
            text-align: right;
        }
        th {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>پیام جدید از صفحه تماس با ما</h1>
        </div>
        <div class="content">
            <p><strong>نام کامل:</strong> {{ $name }}</p>
            <p><strong>آدرس ایمیل:</strong> {{ $email }}</p>
            <p><strong>موضوع:</strong> {{ $subject }}</p>
            <p><strong>پیام:</strong></p>
            <p>{{ $message }}</p>
        </div>
        <div class="footer">
            <p>این ایمیل به صورت خودکار ارسال شده است. لطفاً به این ایمیل پاسخ ندهید.</p>
        </div>
    </div>
</body>
</html>
