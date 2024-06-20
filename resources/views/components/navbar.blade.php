<nav class="flex flex-col gap-5">
  <div class="nav-top justify-evenly hidden sm:flex">
    <a href="{{ route('index') }}" class="flex justify-center items-center">
      <img src="{{ asset('assets/favicon.ico') }}" alt="" style="width: 80px;">
      <span class="ml-3 text-3xl hidden sm:hidden md:hidden xl:block" style="color: #0B1E3F;">StrangerTravel</span>
    </a>
    <div class="nav-items flex gap-10 items-center">
      <a href="#" class="item rounded-full" style="color: var(--bg-100);">HOME</a>
      <a href="#" class="item rounded-full">CHAT</a>
      <a href="#" class="item rounded-full">CALCULATE</a>
    </div>
    <div class="nav-profile flex items-center relative">
      <div class="profile-circle rounded-full flex items-center justify-between" id="showCard">
        <i class="fa-solid fa-bars text-2xl"></i>
        @if (!empty(session('user') || session('user') != ''))
        <div class="profile" style="background-image: {{ asset('storage/userProfiles/') }}"></div>
        @else
        <div class="profile flex justify-center items-center">
          <i class="fa-solid fa-user"></i>
        </div>
        @endif
      </div>
      <div id="card" class="shadow-2xl absolute flex flex-col card-none">
        <div class="card-items" id="login">LOGIN</div>
        <div class="card-items" id="register">REGISTER</div>
      </div>
    </div>
  </div>
  <div class="nav-bottom">
    <div class="search-tap rounded-full">

    </div>
  </div>
</nav>


<script>
  const menuProfile = document.getElementById('showCard')
  menuProfile.addEventListener('click',function(event){
    event.stopPropagation();
    const card = document.getElementById('card')
    if(card.classList.contains('card-none')){
      card.classList.remove('card-none');
      card.classList.add('card-show');
    }else{
      card.classList.remove('card-show');
      card.classList.add('card-none');
    }
  });

  document.body.addEventListener('click',function(){
    const card = document.getElementById('card')
    if(card.classList.contains('card-show')){
      card.classList.remove('card-show');
      card.classList.add('card-none')
    }
  });
  

  const card = document.getElementById('card');
  card.addEventListener('click', function(event) {
    event.stopPropagation();
  });


  // modal


</script>