<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body
        {
            background-color: white !important;
            line-height: 2.4 !important;
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;

            background-size: 100vw;
        }
        @media(max-width:767px)
        {
            .container
            {
                margin-top: 30px !important;
            }
        }
        @media(min-width:768px)
        {
        .header
        {
            background-image: url("http://www.pngall.com/wp-content/uploads/2016/05/Game-of-Thrones-Logo-Free-Download-PNG.png");
            background-repeat: no-repeat;
            height: 160px;
            margin-left: 20%;
        }
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script type="text/javascript" src="/js/app.js"></script>
    @yield('script')
</head>
<body>
    <a href="/">
        <div class="header">
        </div>
    </a>
    <div class="top-right links">
            <a href="{{ url('/') }}">Kings</a>
            <a href="{{ url('/battles') }}">Battles</a>

    </div>
    <div class="container">



    @yield('content')
    </div>
</body>
</html>
