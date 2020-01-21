<!doctype html>
<html>
<head>
    <!--meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!--style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--script -->
    {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <style type="text/css">

        body {
            text-align: center;
        }

        header {
            background: #fff;
            padding: 12px 0;
            margin-bottom: 15px;
        }

        header img {
            width: 60px;
        }

        section .border {
            border: 5px solid #15acc7;
            padding: 15px;
            display: inline-block;
        }

        section p {
            color: #000;
            margin: 15px 0;
        }

        section .verify-btn-section {
            background: #f3f3f3;
            padding: 18px 0px;
            margin: 25px 0;
        }

        section .verify-btn-section a {
            background: #15acc7;
            color: #fff;
            padding: 12px 30px;
            display: inline-block;
            font-size: 20px;
            text-decoration: none;
        }

        footer {
            margin: 20px 0;
        }

    </style>


</head>
<!--Body -->
<body>

<header>
    <div class="container">
        <img width="500px" src="{{ asset('/assets/images/logo.png') }}">
    </div>
</header>

<section class="text-center">
    <div class="container">
        <div class="border">
            <p><strong>Dear {{$company->name}},</strong></p>
            <p><strong>Thank you for creating you account at {{ env('APP_NAME')}}. Please visit {{ env('APP_URL')}}/login or click below.</strong></p>

            <p>Thank you,
                <br><strong>{{config('app.name')}} Team</strong></p>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p class="text-center">{{config('app.name')}} &copy; {{ date('Y') }} All Rights Reserved
            <br> <a href="#">Terms of Use</a> and <a href="#">Privacy
                Policy</a></p>
    </div>
</footer>


</body>
</html>

