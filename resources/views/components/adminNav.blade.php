<nav class="flex p-7">
    <h1 class="text-bold text-2xl">StrangerTravel</h1>
    <form action="{{ route('logoutself') }}" method="post" id="logout-form">
        @csrf
    </form>
    <button onclick="confirmLogout()" class="font-bold px-3 py-2 bg-red-500 hover:bg-red-600 rounded-md ease-in duration-300 text-white" style="margin-left: 3rem;">LOGOUT</button>
</nav>
<script>
    function confirmLogout() {
       Swal.fire({
           title: 'Are you sure?',
           text: 'You will be logged out!',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, logout!'
       }).then((result) => {
           if (result.isConfirmed) {
               // Submit a form with POST method
               document.getElementById('logout-form').submit();
           }
       });
   }
   </script>
   