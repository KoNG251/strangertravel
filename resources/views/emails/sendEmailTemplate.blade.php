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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>send Otp Email</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap');

        *{
            font-family: 'Kanit', sans-serif;
        }

        .otp{
            font-weight: bold;
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <p>เราได้รับคำขอในการสร้าง OTP (One time Password) สำหรับยืนยันตัวตนผ่านทาง Email ของคุณ</p>
    <p>กรุณานำ OTP ไปกรอกที่หน้ากรอก OTP</p>
    <p>รหัสยืนยัน: <span class="otp">{{ $otp }}</span></p>
    <p>*----- เพื่อความปลอดภัย โปรดอย่าแจ้งรหัสนี้กับผู้อื่น -----*</p>
    <p style="font-weight: bold;">----- e-mail ฉบับนี้เป็นการส่งโดยระบบอัตโนมัติ กรุณาอย่าตอบกลับ (reply) -----</p>
</body>
</html>
