<template>
    <nav class="flex justify-center rounded-lg w-full p-4">
        <div class="border border-gray-200 rounded-full shadow-2xl navbar relative">
            <input type="text" v-model="place" name="" id="" class="rounded-s-full rounded-e-full border-0 focus:ring-0 input-search text-xs" placeholder="Search your place">
            <div class="button-search flex justify-center items-center text-xs" @click="search">
                <i class="fa-solid fa-magnifying-glass text-white"></i>
            </div>
        </div>
    </nav>
    <div class="p-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-main">{{ name }}</h1>
            <p><i class="fa-solid fa-location-dot me-2 text-main"></i>{{ province }},{{ amphures }}</p>
            <div class="mt-5">
                <swiper
                        :slides-per-view="1"
                        :space-between="50"
                        :breakpoints="breakpoints"
                        :pagination="{
                            clickable: true,
                            dynamicBullets: true,
                            el: '.swiper-pagination'
                        }"
                        :autoplay="{
                            delay: 3500,
                        }"
                        :keyboard="{
                            enabled: true,
                        }"
                        :modules="modules"
                        class="mySwiper"
                        >
                            <swiper-slide v-for="photo in photos" :key="photo.id">
                                <div :style="{backgroundImage: 'url('+photo.imageUrl+')'}" class="slide rounded-lg"></div>
                            </swiper-slide>
                            <div class="swiper-pagination"></div>
                </swiper>
            </div>
            <div class="mt-5">
                <h1 class="text-xl text-main">About {{ name }}</h1>
                <h4 class="mt-3 text-main">Adress</h4>
                <p class="text-main">{{ address }}</p>
                <h4 class="mt-3 text-main">{{ about }}</h4>
            </div>
            <div class="relative daterange-picture mx-auto p-4">
                <form class="flex gap-4 justify-center" method="get">
                    <input type="text" name="id" class="hidden" :value="id">
                    <div class="cursor-pointer hover:bg-slate-100 duration-300 ease-in-out p-4 rounded-full" @click="showDateRange">
                        <p class="text-sm text-main">Check in</p>
                        <div class="flex items-center">
                            <i class="fi fi-rr-calendar-day me-3"></i>
                            <p>{{ formatDate(dateRange.start) }}</p>
                            <input type="text" :value="dateRange.start" name="start" id="" class="rounded-s-full rounded-e-full border-0 focus:ring-0 input-search text-xs inputdate hidden">
                        </div>
                    </div>
                    <div class="cursor-pointer hover:bg-slate-100 duration-300 ease-in-out p-4 rounded-full">
                        <p class="text-sm text-main">Check out</p>
                        <div class="flex items-center">
                            <i class="fi fi-rr-calendar-day me-3"></i>
                            <p>{{ formatDate(dateRange.end) }}</p>
                            <input type="text" :value="dateRange.end" name="end" id="" class="rounded-s-full rounded-e-full border-0 focus:ring-0 input-search text-xs inputdate hidden">
                        </div>
                    </div>
                    <button>
                        <i class="fi fi-rr-search"></i>
                    </button>
                </form>
                <VDatePicker
                v-model="dateRange"
                is-range
                :min-date="minDate"
                @input="updateFormattedDate"
                :style="{display: datePickerVisible ? 'block' : 'none'}"
                id="datePicker"
                class="mx-auto"
                style="position: absolute; z-index:10;"/>
            </div>

            <div v-if="count != '0'" class="flex justify-between">
                <p class="font-bold text-green-500 text-2xl mb-3">Available room</p>
                <button class="btnSubmit duration-300 ease-in-out p-2 text-white rounded-lg" :disabled="selectedRooms.length === 0" @click="bookingHotel">
                    Booking
                </button>
            </div>
            <div v-else class="w-full rounded-lg border flex justify-center items-center" style="height: 450px;">
                <p class="font-bold text-red-500 text-2xl mb-3">Not have available room for this day</p>
            </div>
            <div class="rounded-lg border-tab grid grid-cols-1 md:grid-cols-4 gap-4 relative" style="z-index:1;">
                <!-- box loop -->
                <label :for="'room'+item.id" :class="['shadow-lg rounded-lg p-4 border border-gray-400', { 'ring-4 ring-blue-500': selectedRooms.includes(item.id) }]"  v-for="item in room" :key="item.id">
                    <h4 class="mb-2 text-xl font-bold">Room number: {{ item.numberOfRoom }} <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{item.room_type}}</span></h4>
                    <div class="flex gap-2 text-base mb-2 font-medium text-main">
                        <i class="fi fi-rr-money-bill-wave"></i>
                        <p>{{ item.price.toLocaleString() }} bath</p>
                    </div>
                    <div class="flex gap-2 text-base mb-2 font-medium text-main">
                        <i class="fi fi-rr-bed"></i>
                        <p>{{ item.numberOfBed }} bed</p>
                    </div>
                    <div class="flex gap-2 text-base mb-2 font-medium text-main">
                        <i class="fi fi-rr-user"></i>
                        <p>{{ sumPeople(item.numberOfBed,item.bed_type) }} people</p>
                    </div>
                    <input type="checkbox" :value="item.id" :id="'room'+item.id" class="hidden" @change="toggleSelection(item.id)">
                </label>
            </div>

        </div>
    </div>
</template>

<style>

.slide{
    width: 100%;
    height: 350px;
    background-size: cover;
    background-position: center;
}

.mySwiper{
    width: 100%;
    height: 380px;
}

.pagination {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    z-index: 10;
}

.swiper-pagination-bullet-active-main{
    background-color: rgb(66, 71, 119);
}

</style>

<script>
import moment from "moment";
import axios from "axios";
import Notiflix from "notiflix";
import Swal from "sweetalert2";
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';
import 'swiper/css/pagination';
import { Pagination, Autoplay, Keyboard } from 'swiper/modules';

export default {
    components: {
        Swiper,
        SwiperSlide
    },
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

        const hotel = params.get('id');

        return {
            breakpoints: {
                        320: {
                        slidesPerView: 1,
                        slidesPerGroup: 1,
                        spaceBetween: 10
                        },
                        640: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        spaceBetween: 20
                        },
                        1024: {
                        slidesPerView: 3,
                        slidesPerGroup: 3,
                        spaceBetween: 30
                        }
                    },
                    modules: [Pagination,Autoplay,Keyboard],
            room: null,
            item: null,
            name: null,
            near: null,
            province: null,
            amphures: null,
            address: null,
            about: null,
            photos: [],
            place: '',
            datePickerVisible: false,
            dateRange: {
            start: defaultStart,
            end: defaultEnd,
            },
            minDate: new Date(),
            id: hotel,
            selectedRooms: []
        };
    },
    props: {
        indexRoute: String,
        itemArray: String,
        roomArray: String,
        pictureHotelRoute: String,
        count: String,
        addBookingRoute: String,
        csrkToken: String,
        bookingInformationRoute: String
    },
    methods: {
        search(){
            window.location.href = this.indexRoute+'?place='+this.place
        },
        getStyle(imageUrl, index) {
            const styles = {
                backgroundImage: `url(${imageUrl})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
            };
            return styles;
        },
        sumPeople(value,bed){
            return parseInt(value) * parseInt(bed);
        },
        updateFormattedDate(value) {
            this.dateRange.start = moment(value.start).format('YYYY-MM-DD');
            this.dateRange.end = moment(value.end).format('YYYY-MM-DD');
            this.datePickerVisible = false;
        },
        formatDate(date) {
            return moment(date,'YYYY-MM-DD').format('MMM DD');
        },
        showDateRange(){
            this.datePickerVisible =!this.datePickerVisible;
        },
        toggleSelection(roomId) {
            if (this.selectedRooms.includes(roomId)) {
                this.selectedRooms = this.selectedRooms.filter(id => id !== roomId);
            } else {
                this.selectedRooms.push(roomId);
            }
        },
        bookingHotel(){

            const start = moment(this.dateRange.start).format('YYYY-MM-DD')
            const end = moment(this.dateRange.end).format('YYYY-MM-DD')

            window.location.href = `${this.bookingInformationRoute}?id=${this.id}&start=${start}&end=${end}&room=${this.selectedRooms}`

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
        limitedPhotos() {
            return this.photos.slice(0, 4);
        },
    },
    mounted() {
        this.item = this.itemArray.replace(/[\u0000-\u001F\u007F-\u009F]/g, "");
        this.item = JSON.parse(this.item);
        this.room = JSON.parse(this.roomArray);
        this.item.forEach((item) => {
            this.name = item.hotelName;
            this.near = item.near;
            this.province = item.province;
            this.amphures = item.amphures;
            this.address = item.address;
            this.about = item.about;
            const urls = item.photos.split(',').map(photo => this.pictureHotelRoute+'/'+ photo.trim());
            this.photos = [...this.photos, ...urls.map(url => ({ imageUrl: url }))];
        });
    },
};
</script>
