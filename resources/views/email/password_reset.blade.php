<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازیابی رمز عبور</title>
    <style>
        body {
            font-family: 'Vazir', Tahoma, Arial, sans-serif;
            background-color: #f0f4f8;
            color: #2d3748;
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
        }
        .header {
            background-color: #4a5568;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            color: #2d3748;
            margin-top: 0;
        }
        .footer {
            background-color: #edf2f7;
            color: #4a5568;
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
        }
        .button {
            display: inline-block;
            background-color: #4299e1;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #edf2f7;
            border-radius: 5px;
            color: #2d3748;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>بازیابی رمز عبور</h1>
        </div>
        <div class="content">
            <p>با سلام،</p>
            <p>شما درخواست بازیابی رمز عبور داده‌اید. لطفاً با کلیک بر روی دکمه زیر رمز عبور خود را بازیابی کنید.</p>
            
            <!-- Reset Button -->
            <p style="text-align: center;">
                <a href="{{ $reset_url }}" class="button">بازیابی رمز عبور</a>
            </p>
            
            <!-- Token Section -->
            <p style="text-align: center; font-weight: bold;">یا می‌توانید از کد زیر استفاده کنید:</p>
            <div class="code">{{ $token }}</div>

            <p>اگر شما این درخواست را نداده‌اید، لطفاً این پیام را نادیده بگیرید.</p>
        </div>
        <div class="footer">
            <p>این ایمیل به صورت خودکار ارسال شده است. لطفاً به این ایمیل پاسخ ندهید.</p>
        </div>
    </div>
</body>
</html>
