<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'OpenBook' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9;
            color: #2d3748;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f7f9;
            padding-bottom: 40px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 40px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #2563EB 0%, #14B8A6 100%);
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header-logo {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: inline-block;
            line-height: 60px;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px;
        }
        .content h2 {
            color: #2563EB;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .details-box {
            background-color: #f9fafb;
            border: 1px solid #edf2f7;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
        }
        .details-item {
            margin-bottom: 12px;
            font-size: 15px;
        }
        .details-item strong {
            color: #4a5568;
            width: 140px;
            display: inline-block;
        }
        .btn-container {
            text-align: center;
            margin: 35px 0;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            transition: transform 0.2s;
        }
        .footer {
            text-align: center;
            padding: 30px;
            font-size: 13px;
            color: #718096;
        }
        .footer p {
            margin: 5px 0;
        }
        .accent-bar {
            height: 4px;
            background: linear-gradient(90deg, #2563EB 0%, #14B8A6 100%);
        }
        @media only screen and (max-width: 600px) {
            .content { padding: 25px; }
            .container { margin-top: 20px; border-radius: 0; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="header-logo">O</div>
                <h1 style="margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px; text-transform: uppercase;">OpenBook</h1>
                <p style="margin: 5px 0 0; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; opacity: 0.8;">La Academia Digital</p>
            </div>
            <div class="accent-bar"></div>
            <div class="content">
                @yield('content')
            </div>
            <div class="footer">
                <p><strong>OpenBook - La Academia Digital</strong></p>
                <p>Este es un mensaje automático, por favor no respondas.</p>
                <p>© {{ date('Y') }} OpenBook. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>
