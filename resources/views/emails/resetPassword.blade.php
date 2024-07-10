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
    </style>
</head>
<body >

    <div class="background">
        <a href="{{ route('reset_password',['id'=>$id_hash,'email'=>$email]) }}">clickhere</a>
    </div>

</body>
</html>
