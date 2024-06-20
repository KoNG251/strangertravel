<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/verify.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap');

        *{
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <title>StrangerTravel</title>
</head>
<body>
    @include('sweetalert::alert')
    <div class="grid w-screen h-screen place-items-center">
        <div class="display rounded-xl shadow-2xl text-center p-4">
            <p class="font-bold text-lg mb-10">Please Enter the OTP to verify your Account</p>
            <p class="text-base">A OTP (one time password) has been sent to</p>
            <form action="{{ route('auth.checkEmailOtp') }}" method="POST" class="flex gap-x-4 justify-center mt-10" id="form-otp">
                @csrf
                <input type="text" maxlength="1" class="otp focus:ring-0" name="otp1" placeholder="X" oninput="moveFocusNext(this, 'otp2')" onkeyup="moveFocusBack(this, 'otp1')">
                <input type="text" maxlength="1" class="otp focus:ring-0" name="otp2" placeholder="X" oninput="moveFocusNext(this, 'otp3')" onkeyup="moveFocusBack(this, 'otp1')">
                <input type="text" maxlength="1" class="otp focus:ring-0" name="otp3" placeholder="X" oninput="moveFocusNext(this, 'otp4')" onkeyup="moveFocusBack(this, 'otp2')">
                <input type="text" maxlength="1" class="otp focus:ring-0" name="otp4" placeholder="X" oninput="moveFocusNext(this, 'otp5')" onkeyup="moveFocusBack(this, 'otp3')">
                <input type="text" maxlength="1" class="otp focus:ring-0" name="otp5" placeholder="X" oninput="moveFocusNext(this, 'otp6')" onkeyup="moveFocusBack(this, 'otp4')">
                <input type="text" maxlength="1" class="otp focus:ring-0" name="otp6" placeholder="X" onkeyup="moveFocusBack(this, 'otp5')">
            </form>
            <div class="w-full grid grid-rows-2 mt-5 md:mt-14 px-0 md:px-14 gap-y-5">
                <button class="bg-red-400 hover:bg-red-500 text-white h-14 rounded-md duration-700 ease-in-out" id="validate">Validate OTP</button>
                <a href="{{ route('auth.emailVerify') }}" class="text-slate-600 hover:text-slate-800 duration-700 ease-in-out">Resend OTP</a>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const submitOtp = document.getElementById("validate");

    submitOtp.addEventListener("click", function() {
        document.getElementById('form-otp').submit();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  var countdownElement = document.getElementById('countdown');
  var button = document.getElementById('resend');

  var countdownTime = 5 * 60 * 1000; // 5 minutes in milliseconds
  var endTime = Date.now() + countdownTime;

  var interval = setInterval(function() {
    var now = Date.now();
    var distance = endTime - now;

    // Calculate time left
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result
    countdownElement.innerHTML = minutes + "m " + seconds + "s ";

    // If the countdown is finished, enable the button
    if (distance < 0) {
      clearInterval(interval);
      countdownElement.innerHTML = "";
      button.disabled = false;
    }
  }, 1000);
});

</script>

<script>
    window.onload = function() {
        document.getElementsByName('otp1')[0].focus();
    };

    function moveFocusNext(currentInput, nextInputName) {
      if(currentInput.value.length === currentInput.maxLength) {
        document.getElementsByName(nextInputName)[0].focus();
      }
    }

    function moveFocusBack(currentInput, previousInputName) {
      if(currentInput.value.length === 0 && event.key === "Backspace") {
        document.getElementsByName(previousInputName)[0].focus();
      }
    }
  </script>

