<template>
    <div class="container mx-auto nav bg-white px-3 xl:px-0 rounded-lg">
        <nav class="shadow-md rounded-lg bg-white">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase">stranger travel</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white gap-4">
                    <li>
                        <a href="/" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a :href="calculateRoute" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Calculate</a>
                    </li>
                    <li v-if="!userData">
                        <a :href="loginPath" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Login</a>
                    </li>
                    <li v-if="!userData">
                        <a :href="registerPath" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Register</a>
                    </li>
                    <li v-if="userData">
                        <a :href="chatRoute" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Chat</a>
                    </li>
                    <li v-if="userData">
                        <a :href="profileRoute" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Setting</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mx-auto px-3 xl:px-0 mt-24">
        <swiper
            :slides-per-view="1"
            :parallax="true"
            :loop="true"
            :autoplay="{
                            delay: 3500,
            }"
            :modules="modules"
        >
            <swiper-slide class="rounded-lg">
                <div class="w-full nav-picture rounded-lg p-10" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                    <div class="bg-text flex justify-center flex-col rounded-lg">
                        <p>Welcome to</p>
                        <h1 style="font-size:50px">Stranger Travel</h1>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide class="rounded-lg">
                <div class="w-full nav-picture rounded-lg p-10 flex items-center" style="background-image: url('https://images.unsplash.com/photo-1572529593091-6c05c37cacc7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                    <div class="bg-text flex justify-center flex-col rounded-lg">
                        <p>We are</p>
                        <h1 style="font-size:50px">Booking website</h1>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide class="rounded-lg">
                <div class="w-full nav-picture rounded-lg p-10 flex items-center" style="background-image: url('https://images.unsplash.com/photo-1676002797799-eddf053ab91e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                    <div class="bg-text flex justify-center flex-col rounded-lg">
                        <p>We have</p>
                        <h1 style="font-size:50px">Chat group</h1>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
        <div class="box-search rounded-lg mx-auto shadow-md">
            <div class="bg-blue rounded-lg"></div>
            <div class="search flex items-center">
                <form method="get" class="w-full grid grid-cols-9 gap-4">
                    <div class="col-span-4 md:col-span-2">
                        <input type="text" name="place" v-model="place" class="search-input focus:ring-0" placeholder="Location">
                        <p class="text-gray-400 mt-2">Where are you going?</p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <input type="text" name="start" v-model="start" ref="start" class="search-input focus:ring-0" id="start" placeholder="Check-in">
                        <p class="text-gray-400 mt-2">Add date</p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <input type="text" name="end" v-model="end" ref="end" class="search-input focus:ring-0" placeholder="Check-out">
                        <p class="text-gray-400 mt-2">Add date</p>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <input type="text" name="guest" class="search-input focus:ring-0" placeholder="Location">
                        <p class="text-gray-400 mt-2">Add guest</p>
                    </div>
                    <div class="flex items-center">
                        <button type="submit" class="button-search rounded-full duration-300 ease-in-out text-white flex items-center justify-center text-xl">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import axios from 'axios';
import Notiflix from 'notiflix';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import { Autoplay,Parallax } from 'swiper/modules';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';


export default {

    components: {
      Swiper,
      SwiperSlide,
    },
    data(){

        const params = new URLSearchParams(window.location.search);

        let defaultPlace = '';
        let defaultStart = moment().format("YYYY-MM-DD");
        let defaultEnd = moment().add(1, "days").format("YYYY-MM-DD");

        if (params.has('place')) {
            defaultPlace = params.get('place');
        }

        if (params.has('start')) {
            defaultStart = params.get('start')
        }

        if (params.has('end')) {
            defaultEnd = params.get('end')
        }

        return {
            place: defaultPlace,
            start: defaultStart,
            end: defaultEnd,
            modules: [Autoplay,Parallax]
        };
    },
    props: {
        loginPath: String,
        registerPath: String,
        user: {
            type: String,
            default: ''
        },
        chatRoute: String,
        profileRoute: String,
        calculateRoute: String
    },
    computed: {
        userData() {
            try {
                return JSON.parse(this.user);
            } catch(e) {
                return null;
            }
        }
    },
    mounted() {
        flatpickr(this.$refs.start, {
            dateFormat: 'Y-m-d',
            minDate: "today"
        });

        flatpickr(this.$refs.end, {
            dateFormat: 'Y-m-d',
            minDate: this.start
        });
    },
    methods : {

    },
     watch: {

    }

}
</script>
