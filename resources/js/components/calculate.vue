<template>
    <div class="display h-svh grid place-items-center bg-no-repeat bg-bottom bg-contain" :style="{backgroundImage: 'url('+background+')'}">
        <div class="card border border-gray-200 shadow-xl p-3 overflow-x-hidden overflow-y-scroll">
            <h1 class="text-center text-2xl font-bold mb-6">Calculate Budget</h1>
            <div class="relative">
                <input type="text" id="place" v-model="place" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer" placeholder=" " />
                <label for="place" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Where you go?</label>
            </div>
            <div class="relative mt-5">
                <input type="number" id="budget" v-model="budget" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer" placeholder=" " />
                <label for="budget" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Budget</label>
            </div>
            <div class="mt-5 flex justify-evenly">
                <div class="box-date rounded-lg hover:bg-blue-300 duration-300 ease-in-out grid place-items-center cursor-pointer" @click="openCalendar">
                    <h1 class="text-xl font-semibold">{{ formatDate(dateRange.start) }}</h1>
                </div>
                <div class="box-date rounded-lg hover:bg-blue-300 duration-300 ease-in-out grid place-items-center cursor-pointer" @click="openCalendar">
                    <h1 class="text-xl font-semibold">{{ formatDate(dateRange.end) }}</h1>
                </div>
            </div>
            <VDatePicker class="mx-auto mt-5"
            v-model="dateRange"
            is-range
            @input="updateFormattedDate"
            :style="{display: calendarVisible ? 'block' : 'none'}"
            :min-date="minDate"
            id="datePicker"/>
            <div class="mt-5">
                <div class="flex justify-evenly">
                    <div class="box-date text-center text-xl font-semibold hover:bg-blue-300 duration-300 ease-in-out grid place-items-center cursor-pointer rounded-lg" @click="openGuestCard">{{ `Adult ${adult}` }}</div>
                    <div class="box-date text-center text-xl font-semibold hover:bg-blue-300 duration-300 ease-in-out grid place-items-center cursor-pointer rounded-lg" @click="openGuestCard">{{ `Children ${child}` }}</div>
                </div>
                <div class="guest-card mx-auto shadow-xl rounded-lg p-4 border border-gray-300 flex flex-col justify-center mt-5" :style="{display: guestVisible ? 'block' : 'none'}">
                    <h1 class="text-xl font-semibold text-center">Adult</h1>
                    <div class="flex justify-around">
                        <button class="text-center text-xl" type="button" @click="adult--" :disabled="adult == 1">
                            <i class="fa-solid fa-circle-minus cursor-pointer hover:text-blue-700 duration-300 ease-in-out"></i>
                        </button>
                        <div>
                            <input type="number" name="adult" v-model="adult" class="people focus:ring-0" readonly>
                        </div>
                        <button class="text-center text-xl" type="button" @click="adult++">
                            <i class="fa-solid fa-circle-plus cursor-pointer hover:text-blue-700 duration-300 ease-in-out"></i>
                        </button>
                    </div>
                    <h1 class="text-xl font-semibold text-center">Child</h1>
                    <div class="flex justify-around">
                        <button class="text-center text-xl" type="button" @click="child--" :disabled="child == 0">
                            <i class="fa-solid fa-circle-minus cursor-pointer hover:text-blue-700 duration-300 ease-in-out"></i>
                        </button>
                        <div>
                            <input type="number" name="child" v-model="child" class="people focus:ring-0" readonly>
                        </div>
                        <button class="text-center text-xl" type="button" @click="child++">
                            <i class="fa-solid fa-circle-plus cursor-pointer hover:text-blue-700 duration-300 ease-in-out"></i>
                        </button>
                    </div>
                    <button type="button" class="bg-blue-600 hover:bg-blue-800 duration-300 ease-in-out text-center p-2 rounded-md text-white w-full mt-4" @click="openGuestCard">SUBMIT</button>
                </div>
            </div>
            <div class="w-full mt-5">
                <button @click="CalculateBudget" class="bg-blue-600 hover:bg-blue-800 duration-300 ease-in-out text-center p-2 rounded-md text-white w-full">CALCULATE</button>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import axios from 'axios';
    import Notiflix from 'notiflix';
    import VCalendar from 'v-calendar';
    import 'v-calendar/style.css';



        export default {
            data(){

                let defaultStart = moment().format("YYYY-MM-DD");
                let defaultEnd = moment().add(1, "days").format("YYYY-MM-DD");

                return  {
                    dateRange : {
                        start: defaultStart,
                        end: defaultEnd
                    },
                    minDate: new Date(),
                    calendarVisible: false,
                    child: 0,
                    adult: 2,
                    guestVisible: false,
                    budget: null,
                    place: ''
                }
            },
            props:{
                background: String,
                csrfToken: String,
            },
            methods: {
                formatDate(date) {
                    return moment(date,'YYYY-MM-DD').format('YYYY MMM DD');
                },
                updateFormattedDate(value) {
                    this.dateRange.start = moment(value.start).format('YYYY-MM-DD');
                    this.dateRange.end = moment(value.end).format('YYYY-MM-DD');
                    this.calendarVisible = false;
                },
                openCalendar(){
                    this.calendarVisible = !this.calendarVisible;
                },
                openGuestCard(){
                    this.guestVisible = !this.guestVisible;
                },
                CalculateBudget(){

                    window.location = `/calculate/results?place=${this.place}&start=${this.dateRange.start}&end=${this.dateRange.end}&adult=${this.adult}&child=${this.child}&budget=${this.budget}`

                }

            },
            watch: {
                dateRange: {
                    deep: true,
                    handler(value) {
                        this.updateFormattedDate(value);
                    }
                }
            },
            computed: {

            },
            mounted() {

            },
        }
    </script>
