<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap');

        *{
            font-family: 'Kanit', sans-serif;
        }

        .text-red{
            color: rgb(243, 54, 54);
        }

        .text-white{
            color: #fff;
        }

        .background {
            width: 1080px;
            background-color: #0B1E3F;
            padding: 40px;
            margin: 0 auto;
        }

        .flex{
            display: flex;
        }

        .card{
            width: 500px;
            height: 500px;
            background: white;
            border-radius: 20px;
            padding: 10px;
        }

        .button{
            text-align: center !important;
            background-color: #0B1E3F !important;
            width: 200px;
            height: 50px;
            border-radius: 5px;
            color: #fff;
            display: grid !important;
            place-items: center !important;
        }

        .button:hover{
            background-color: #254B7B;
        }

        .text-blue{
            color: #0B1E3F
        }

        .mx-auto{
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>
<body >

    <div class="background">
        <div class="mx-auto card">
            <h1 class="text-blue" style="text-align: center;">Reset your password</h1>
            <a href="{{ route('reset_password',['id'=>$id_hash,'email'=>$email]) }}" class="button mx-auto" style="margin-top: 20px; margin-bottom: 20px;">
                <span>RESET HERE</span>
            </a>
            <p class="text-red" style="text-align: center;">please do not send this link to another people</p>
        </div>
    </div>

</body>
</html>
