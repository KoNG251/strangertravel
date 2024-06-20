<template>


<footer class="bg-white w-full">
    <div class="mx-auto w-full p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="/" class="flex items-center">
                  <img :src="logoPrimary" class="h-8 me-3" alt="strangertravel Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap">Stranger Travel</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Calculate</h2>
                  <ul class="text-gray-500  font-medium">
                      <li class="mb-4">
                          <a href="/calculate" class="hover:underline">Calculate</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">About us</h2>
                  <ul class="text-gray-500 -400 font-medium">
                      <li class="mb-4">
                          <a href="๒" class="hover:underline ">About us</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Legal</h2>
                  <ul class="text-gray-500  font-medium">
                      <li class="mb-4">
                          <a href="/manager" class="hover:underline">Manager</a>
                      </li>
                      <li class="mb-4">
                          <a href="/admin" class="hover:underline">Admin</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="/" class="hover:underline">STRANGER TRAVEL™</a>. All Rights Reserved.
          </span>

      </div>
    </div>
</footer>

</template>

<script>

        export default {
            props:{
                logo: String,
                background: String,
                csrfToken: String,
                logoPrimary: String
            },
        }
    </script>
