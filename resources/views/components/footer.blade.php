<footer class="mt-auto w-full text-white p-10 grid grid-rows-1">
    <div class="ft-join w-full">
        <h1 class="text-center text-3xl mb-7 md:mb-10">ต้องการที่จะเพิ่มที่พักของท่านหรือไม่</h1>
        <a href="{{ route('managerCreate') }}" class="text-center our-hotel transition duration-300 ease-in-out hover:shadow-md hover:shadow-white">ลงทะเบียนที่พักของท่าน</a>
        <img src="{{ asset('assets/picture/ft-picture.png') }}" class="ft-picture hidden md:block">
    </div>
</footer>

<style>

    :root{
        --primary-100:#0077C2;
        --primary-200:#59a5f5;
        --primary-300:#c8ffff;
        --accent-100:#00BFFF;
        --accent-200:#00619a;
        --text-100:#333333;
        --text-200:#5c5c5c;
        --bg-100:#FFFFFF;
        --bg-200:#f5f5f5;
        --bg-300:#cccccc;
    }

    footer{
        background-color: var(--primary-100);
        height: auto;
        overflow: hidden;
    }

    .ft-join{
        height: 590px;
        text-align: center;
        overflow: hidden;
    }

    .ft-info{
        height: 400px;
    }

    .our-hotel{
        border: 1px solid whitesmoke;
        padding: 5px;
        border-radius: 5px;
        margin-top: 15px;
    }

    .our-hotel:hover{
        background-color: whitesmoke;
        color: #050F15;
    }

    .ft-picture{
        margin-top: 2rem;
        height: 500px;
        width: 100%;
    }

    .ft-logo{
        width: 300px;
        height: 300px;
    }

    @media screen and (max-width: 640px) {
        .ft-join{
            height: 200px;
            text-align: center;
            overflow: hidden;
        }
    }

</style>