<template>
    <div class="h-svh p-3 bg-no-repeat bg-bottom bg-contain" :style="{backgroundImage: 'url('+background+')'}">
        <div class="mx-auto display grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="card-info shadow-xl bg-no-repeat bg-right-bottom" :style="{backgroundImage: `url(${image1})`}">
                <h1 class="text-center font-semibold text-xl">Number of guests</h1>
                <p class="text-sm mt-3">{{ `${guest.adult} Adult` }}</p>
                <p class="text-sm mt-3">{{ `${guest.child} Children` }}</p>
                <p class="text-sm mt-3">{{ `Total ${sum(guest.child,guest.adult)} people` }}</p>
                <!-- <img :src="image1" class="card-image absolute bottom-0 right-0"> -->
            </div>
            <div class="card-info shadow-xl bg-no-repeat bg-right-bottom" :style="{backgroundImage: `url(${image2})`}">
                <h1 class="text-center font-semibold text-xl">Date of stay</h1>
                <p class="text-sm mt-3">{{ `Check in date` }}</p>
                <p class="text-sm mt-1">{{ `${formatDate(date.start)}` }}</p>
                <p class="text-sm mt-3">{{ `Check out date` }}</p>
                <p class="text-sm mt-1">{{ `${formatDate(date.end)}` }}</p>
                <p class="text-sm mt-3">{{ `Total amount` }}</p>
                <p class="text-sm mt-1">{{ `${date.sumday} Night ${sum(date.sumday,1)} Days` }}</p>
            </div>
            <div class="card-info shadow-xl bg-no-repeat bg-right-bottom" :style="{backgroundImage: `url(${image3})`}">
                <h1 class="text-center font-semibold text-xl">Budget</h1>
                <p class="text-sm mt-3">{{ `Amount` }}</p>
                <p class="text-sm mt-1">{{ `${budget.amount}` }}</p>
                <p class="text-sm mt-3">{{ `Calculate` }}</p>
                <p class="text-sm mt-3">{{ `${budget.perday} Bath/Night` }}</p>
            </div>
        </div>

        <div class="display mx-auto mt-7 bg-none">
            <div class="card shadow-xl border border-gray-200 overflow-y-scroll grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3" v-if="room != ''">
                <h1 class="text-center font-semibold text-xl md:col-span-2 xl:col-span-3">Recommend Hotel</h1>
                <a class="w-full" :href="`/booking/hotel/information?id=${room.id}&start=${date.start}&end=${date.end}`" v-for="room in room" :key="room.id">
                    <div class="box-info w-full rounded-md bg-cover bg-no-repeat bg-center" :style="{backgroundImage: `url(${pictureHotelRoute}/${room.photos[0]})`}"></div>
                    <h3 class="text-semibold text-lg mt-4">{{ room.hotelName }}</h3>
                    <p class="text-sm text-gray-400 font-thin">{{ room.province }}</p>
                </a>
            </div>
            <div class="card shadow-xl border border-red-400 overflow-y-scroll grid place-items-center" v-else>
                <h1 class="text-xl text-red-500">There is no hotel according to your budget.</h1>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import axios from "axios";
import Notiflix from "notiflix";

export default {
    data() {
        const params = new URLSearchParams(window.location.search);
        const defaultStart = new Date(params.get("start"));
        const defaultEnd = new Date(params.get("end"));

        return {
            place: params.get("place"),
            budget: {
                amount: params.get("budget"),
                perday: 0,
            },
            date: {
                start: defaultStart,
                end: defaultEnd,
                sumday: 0
            },
            guest: {
                adult: params.get("adult"),
                child: params.get("child"),
            },
            room: null,
        };
    },
    props: {
        background: String,
        csrfToken: String,
        image1: String,
        image2: String,
        image3: String,
        pictureHotelRoute: String
    },
    methods: {
        formatDate(date) {
            return moment(date, "YYYY-MM-DD").format("YYYY MMMM DD");
        },
        results() {
            const startDate = moment(this.date.start).format("YYYY-MM-DD");
            const endDate = moment(this.date.end).format("YYYY-MM-DD");
            axios
                .post("/calculate/api/results", {
                    province: this.place,
                    budget: this.budget.amount,
                    start: startDate,
                    end: endDate,
                    adults: this.guest.adult,
                    children: this.guest.child,
                    headers: {
                        "X-CSRF-TOKEN": this.csrfToken,
                    },
                })
                .then((response) => {
                    this.budget.perday = response.data.message.price.perday;
                    this.date.sumday = response.data.message.date.sumday;
                    this.room = response.data.message.item.hotels
                    this.room.forEach((item, index) => {
                        this.room[index].photos = item.photos.split(',');
                    });
                })
                .catch((error) => {
                    Notiflix.Report.failure(
                        "Error",
                        error.response.data.message,
                        "Okay",
                        () => {
                            window.location.href = "/calculate";
                        }
                    );
                });
        },
        sum(value1,value2){
            return parseInt(value1) + parseInt(value2);
        }
    },
    watch: {},
    computed: {},
    mounted() {
        this.results();
    },
};
</script>
