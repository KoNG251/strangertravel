<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/create_chat.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>StrangerTravel</title>
</head>
<body class="bg-gradient-to-r from-blue-500 to-blue-600">
    @include('sweetalert::alert')
    <div class="h-screen flex justify-center items-center">
        <div class="container box-login w-5/6 h-fit md:h-5/6 bg-white rounded-2xl px-3 py-1 md:p-10">
            <a href="{{ route('chatGroup') }}" class="text-base font-bold flex items-center"><i class="fa-solid fa-caret-left"></i> กลับ</a>
            <form class="container grid grid-cols-1 py-4 md:py-10 gap-10" enctype="multipart/form-data" method="POST" action="{{ route('createGroup') }}">
                @csrf
                <div class="col-span-1 w-full h-10 md:h-14 flex justify-center">
                    <img id="preview" src="{{asset('assets/picture/groupProfiles/example.svg')}}" alt="Example Image" class="w-20 h-20 rounded-full border border-black">
                </div>
                <div class="col-span-1 w-full h-10 md:h-14">
                    <label for="picture" class="font-bold md:text-base text-xs " autocomplete="false"> อัปโหลดไฟล์รูป
                        <div class="upload pl-2 md:pl-5 h-full w-full border-black rounded-md ring-1 ring-gray-600 text-xs md:text-base flex justify-center items-center hover:bg-blue-400 hover:ring-2">อัปโหลดไฟล์</div>
                        <input type="file" name="file" id="picture" placeholder="อัปโหลดรูปกลุ่ม" class="pl-2 md:pl-5 h-full w-full border-black rounded-md ring-1 ring-gray-400 text-xs md:text-base hidden" accept="image/*">
                        @error('picture')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="col-span-1 w-full h-10 md:h-14">
                    <label for="name" class="font-bold md:text-base text-xs" autocomplete="false"> ชื่อกรุ๊ป
                        <input type="text" name="name" id="name" placeholder="ชื่อกรุ๊ป" class="pl-2 md:pl-5 h-full w-full border-black rounded-md ring-1 ring-gray-400 text-xs md:text-base">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="col-span-1 w-full h-10 md:h-14">
                    <label for="detail" class="font-bold md:text-base text-xs" autocomplete="false"> รายละเอียดกลุ่ม
                        <textarea type="text" name="detail" id="detail" placeholder="รายละเอียดกลุ่ม" class="pl-2 md:pl-5 h-full w-full border-black rounded-md ring-1 ring-gray-400 text-xs md:text-base"></textarea>
                        @error('detail')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="col-span-1 w-full h-10 md:h-14 flex justify-center">
                    <button type="submit" name="submit" class="w-1/2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
const imageInput = document.getElementById("picture");
const preview = document.getElementById("preview");

imageInput.addEventListener("change", function() {

    const file = imageInput.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ asset('assets/picture/groupProfiles/example.svg') }}";
    }
});
</script>
