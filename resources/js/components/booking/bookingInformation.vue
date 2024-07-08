<template>
    <div class="w-full">
        <ol class="mx-auto flex justify-center items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg sm:p-4 sm:space-x-4 rtl:space-x-reverse">
            <li class="flex items-center text-blue-600">
                <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0">
                    1
                </span>
                Select <span class="hidden sm:inline-flex sm:ms-2">hotel</span>
                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                </svg>
            </li>
            <li class="flex items-center text-blue-600">
                <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0">
                    2
                </span>
                Fill <span class="hidden sm:inline-flex sm:ms-2">infomation</span>
                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                </svg>
            </li>
            <li class="flex items-center">
                <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0">
                    3
                </span>
                Payment
            </li>
        </ol>
    </div>
    <div class="box-grid mx-auto">
        <div class="grid grid-cols-12 gap-4 p-4 md:p-0">
            <div class="col-start-1 col-end-13 md:col-end-4 border rounded-lg p-4">
                 <h2 class="text-lg font-semibold mb-2">{{ name }}</h2>
                 <p class="text-sm font-light mb-2">{{ address }}</p>
                 <p class="text-sm font-semibold mb-2">Near</p>
                 <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-100 text-black text-xs font-medium me-2 px-2.5 py-0.5 rounded border-gray-500" v-for="(item, index) in nearList" :key="index">{{item}}</span>
                 </div>
            </div>
            <div class="col-start-1 col-end-13 md:col-end-4 border rounded-lg p-4">
                <h2 class="text-lg font-semibold mb-2">Your booking details</h2>
                <div class="flex mb-2">
                    <div class=" border-e pe-4">
                        <h4 class="text-base font-semibold">Check in</h4>
                        {{ formatDate(dateRange.start) }}
                    </div>
                    <div class="px-4">
                        <h4 class="text-base font-semibold">Check out</h4>
                        {{ formatDate(dateRange.end) }}
                    </div>
                </div>
                <h4 class="text-base font-semibold">Total length of stay:</h4>
                <p class="pb-2 border-b border-gray-700 mb-2">{{ dateDifference }} Nights</p>
                <div class="">
                    <p class="text-base font-light mb-2">You selected</p>
                    <h4 class="text-lg font-semibold mb-2">{{ allRoom }} room</h4>
                </div>


            </div>
            <div class="col-start-1 col-end-13 md:col-end-4 border rounded-lg">
                <h2 class="text-lg m-4 font-semibold mb-2">Your price summary</h2>
                <div class="w-full h-36 bg-blue-300 mb-6 p-4 flex items-center justify-between">
                    <div>
                        <h4 class="text-2xl font-semibold">Total</h4>
                    </div>
                    <div>
                        <span class="text-2xl font-semibold">THB {{ allPrice.toLocaleString() }}</span>
                    </div>
                </div>
            </div>
            <div class="row-start-1 row-end-2 border rounded-lg col-start-4 col-end-13 hidden md:block p-4">

            </div>
            <form class="row-start-2 row-end-4 border rounded-lg col-start-4 col-end-13 hidden md:block p-4" @submit.prevent="confirmInfo">
                <h4 class="text-xl font-bold mb-4">Enter your details</h4>
                <div class="w-full p-2 border-2 text-white border-red-500 bg-red-400 rounded-md mb-4">
                    Almost done! Just fill in the * required info
                </div>
                <div class="grid grid-cols-2 gap-9">
                    <div class="relative">
                        <input type="text" v-model="userList.fname" name="fname" id="fname" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="fname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First name</label>
                    </div>
                    <div class="relative">
                        <input type="text" v-model="userList.lname" name="lname" id="lname" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="lname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Last name</label>
                    </div>
                    <div class="relative">
                        <input type="email" v-model="userList.email" name="email" id="email" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="email" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email</label>
                    </div>
                    <div></div>
                    <div class="relative">
                        <input type="text" maxlength="10" v-model="userList.tel" name="tel" id="tel" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="tel" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone number</label>
                    </div>
                </div>
                <button class="mt-5 btnSubmit p-2 w-28 rounded-lg text-white">Confirm</button>
            </form>

            <form class="col-start-1 col-end-13 border rounded-lg block md:hidden p-4" @submit.prevent="confirmInfo">
                <h4 class="text-xl font-bold mb-4">Enter your details</h4>
                <div class="w-full p-2 border-2 text-white border-red-500 bg-red-400 rounded-md text-xs mb-4">
                    Almost done! Just fill in the * required info
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div class="relative">
                        <input type="text" v-model="userList.fname" name="fname" id="fname" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="fname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First name</label>
                    </div>
                    <div class="relative">
                        <input type="text" v-model="userList.lname" name="lname" id="lname" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="lname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Last name</label>
                    </div>
                    <div class="relative">
                        <input type="email" v-model="userList.email" name="email" id="email" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="email" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email</label>
                    </div>
                    <div class="relative">
                        <input type="text" maxlength="10" v-model="userList.tel" name="tel" id="tel" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                        <label for="tel" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white peer-focus:px-2 peer-focus:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone number</label>
                    </div>
                </div>
                <button class="mt-5 btnSubmit p-2 w-28 rounded-lg text-white">Confirm</button>
            </form>

        </div>
    </div>
</template>

<script>
import moment from "moment";
import axios from "axios";
import Notiflix from "notiflix";
import Swal from "sweetalert2";

export default {

    data() {

        const params = new URLSearchParams(window.location.search);

        let defaultStart = moment().format("YYYY-MM-DD");
        let defaultEnd = moment().add(1, "days").format("YYYY-MM-DD");

        if (params.has('start')) {
            defaultStart = new Date(params.get('start'))
        }

        if (params.has('end')) {
            defaultEnd = new Date(params.get('end'))
        }

        return {
            nearList: null,
            dateRange: {
                start: defaultStart,
                end: defaultEnd
            },
            dateDifference: 0,
            roomList: null,
            allPrice: 0,
            allRoom: 0,
            userList: [
                {
                    fname:'',
                    lname: '',
                    email: '',
                    tel: ''
                }
            ],

        };
    },
    props: {
       name: String,
       province: String,
       amphures: String,
       address: String,
       near: String,
       roomArray: String,
       user: String,
       bookingRoute: String,
       infomationRoute: String,
       csrfToken: String,
       paymentRoute: String,
    },
    methods: {
        formatDate(date) {
            return moment(date,'YYYY-MM-DD').format('ddd, D MMM');
        },
        calculateDateDifference() {
            const start = new Date(this.dateRange.start);
            const end = new Date(this.dateRange.end);
            const diffTime = Math.abs(end - start);
            this.dateDifference = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        },
        confirmInfo(){

            const params = new URLSearchParams(window.location.search);
            const id = params.get('id')
            const room = params.get('room')

            axios.post(this.bookingRoute,
                {
                    data: room,
                    start: this.dateRange.start,
                    end: this.dateRange.end,
                    fname: this.userList.fname,
                    lname: this.userList.lname,
                    email: this.userList.email,
                    tel: this.userList.tel,
                    price: this.allPrice
                },
                {
                    headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': this.csrfToken
                    }
                }).then(response => {

                    Notiflix.Report.success(
                        'Success',
                        response.data.message.message,
                        "Okay",
                        () => {
                            window.location.href = `${this.paymentRoute}?id=${response.data.message.bookingId}&price=${this.allPrice}`
                        }
                    )

                }).catch(error => {
                    Notiflix.Report.failure(
                        'Fail',
                        error.response.data.message,
                        "Okay",
                        () => {
                            window.location.href = this.infomationRoute+'?id='+id
                        }
                    )
                })
        }
    },
    watch: {

    },
    computed: {

    },
    mounted() {
        this.calculateDateDifference()
        this.nearList = JSON.parse(this.near)
        this.roomList = JSON.parse(this.roomArray)

        this.roomList.forEach(item => {
            this.allRoom = this.allRoom + 1
            this.allPrice = this.allPrice + parseInt(item.price)
        });

        if (this.user !== null && this.user !== "null") {
            this.userList = JSON.parse(this.user)
        }




    },
};
</script>
