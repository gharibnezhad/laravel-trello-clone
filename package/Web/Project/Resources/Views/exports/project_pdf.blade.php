<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <style>
        @font-face {
            font-family: 'IRANSans';
            src: url('file://{{ public_path("fonts/iransans/IRANSansWeb.ttf") }}') format('truetype');
        }

        body {
            font-family: 'IRANSans', sans-serif;
            direction: rtl;
            text-align: right;
        }

        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
