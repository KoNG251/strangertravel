import { createApp } from 'vue/dist/vue.esm-bundler.js';
import VCalendar from 'v-calendar';
import 'v-calendar/style.css';
import axios from 'axios';
import 'flowbite';
import '@fortawesome/fontawesome-free/js/all.js';


const app = createApp({});
app.use(VCalendar, {});

import Navbar from './components/navbar.vue';
app.component('navbar', Navbar);

import Profile from './components/profile.vue';
app.component('profile',Profile);

import Auth from './components/authentication.vue';
app.component('auth',Auth);

import register from './components/register.vue';
app.component('register',register)

import login from './components/index.vue'
app.component('login',login)

import Calculate from './components/calculate.vue';
app.component('calculate',Calculate)

import calculateResult from './components/results.vue';
app.component('result',calculateResult);

import rePassword from './components/repassword.vue';
app.component('repassword',rePassword);

import Reset from './components/reset.vue';
app.component('reset',Reset);

import History from './components/history.vue'
app.component('history',History);

import Footer from './components/footer.vue';
app.component('index-footer',Footer);


// manager

import managerIndex from './components/manager/index.vue'
app.component('manager-index',managerIndex)

import managerRegister from './components/manager/register.vue'
app.component('manager-register',managerRegister)

import managerAuth from './components/manager/authentication.vue'
app.component('manager-auth',managerAuth)

import add from './components/manager/add.vue'
app.component('manager-add',add);

import picture from './components/manager/picture.vue'
app.component('manager-picture',picture)

import managerHome from './components/manager/home.vue';
app.component('manager-home',managerHome);

import room from './components/manager/room.vue';
app.component('room',room);

import managerEdit from './components/manager/edit.vue';
app.component('manager-edit-room',managerEdit)

import Update from './components/manager/update.vue';
app.component('manager-update',Update);

import UpdateRoom from './components/manager/updateRoom.vue'
app.component('manager-updateroom',UpdateRoom)

//booking

import information from './components/booking/information.vue'
app.component('information',information)

import BookingInformation from './components/booking/bookingInformation.vue'
app.component('bookinginformation',BookingInformation)

import Payment from './components/booking/payment.vue'
app.component('payment',Payment)

import Chat from './components/chat/chat.vue';
app.component('chat',Chat);


// admin import
import AdminIndex from './components/admin/index.vue';
app.component('admin-index',AdminIndex);

import AdminHome from './components/admin/home.vue';
app.component('admin-home',AdminHome);

import AdminHotel from './components/admin/hotel.vue';
app.component('admin-hotel',AdminHotel);

import AdminAccount from './components/admin/account.vue';
app.component('admin-account',AdminAccount);

import AdminCheckHotel from './components/admin/check.vue'
app.component('admin-check',AdminCheckHotel)

app.mount('#app');
