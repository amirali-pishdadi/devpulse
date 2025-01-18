<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کد تأیید ایمیل</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazir', Tahoma, Arial, sans-serif;
            background-color: #f8f9fa;
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
        .verification-code {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>کد تأیید ایمیل شما</h1>
        </div>
        <div class="content">
            <p><strong> {{ $email }}</strong></p>
            <p>برای تکمیل فرآیند ثبت‌نام یا ورود به حساب کاربری خود، لطفاً کد تأیید زیر را وارد کنید:</p>
            <div class="verification-code">
                {{ $code }}
            </div>
            <p>اگر شما این درخواست را انجام نداده‌اید، لطفاً این ایمیل را نادیده بگیرید.</p>
        </div>
        <div class="footer">
            <p>این ایمیل به صورت خودکار ارسال شده است. لطفاً به این ایمیل پاسخ ندهید.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
