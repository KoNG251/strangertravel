<template>
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="text-dark fw-bold my-1 fs-2">Hotel</h1>
                <!--end::Heading-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Hotel</li>
                    <li class="breadcrumb-item text-dark">Check the hotel</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-center flex-shrink-0">

                <!--begin::Theme mode-->
                <div class="d-flex align-items-center ms-2 ms-lg-3">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-icon btn-active-light-primaryw-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-2x">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <!--begin::Menu toggle-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-moon fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-screen fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Theme mode-->
                <!--begin::User-->
                <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-profile-circle fs-2x">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ user.email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a @click="logout" class="menu-link px-5">Sign Out</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User -->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Container-->
    </div>

    <div class="content d-flex flex-column flex-column-fluid">
        <div class="container-xxl ">
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
                    <div :style="{backgroundImage: 'url('+hotelRoute+'/'+photo.photos+')'}" class="slide rounded-lg"></div>
                </swiper-slide>
                <div class="swiper-pagination"></div>
            </swiper>

            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('../assets/media/illustrations/sigma-1/4.png')">
                <!--begin::Card header-->
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <!--begin::Icon-->
                        <div class="symbol symbol-circle me-5">
                            <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                                <i class="ki-duotone ki-home-1 fs-2x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">{{ hotel.hotelName }}</h2>
                            <p>{{ hotel.province }},{{ hotel.amphures }}</p>
                        </div>
                        <!--end::Title-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pb-0">
                    <!--begin::Navs-->
                    <div class="d-flex overflow-auto h-55px">
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-semibold flex-nowrap">
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#information">Hotel infomation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#room">Hotel room</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                    </div>
                    <!--begin::Navs-->
                </div>
                <!--end::Card body-->
            </div>

            <div class="tab-content mb-10" id="myTabContent">
                <div class="card card-flush p-10 tab-pane fade show active" id="information"  role="tabpanel">
                    <div>
                        <h4 class="text-lg text-bold">ที่อยู่</h4>
                        <p>{{ hotel.address }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg text-bold">เกี่ยวกับโรงแรม</h4>
                        <p class="text-break">{{ hotel.about }}</p>
                    </div>
                </div>

                <div class="card card-flush p-10 tab-pane fade" id="room"  role="tabpanel">
                    <div class="d-grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                        <div class="col-span-1 p-10 border rounded-md" v-for="room in room" :key="room.id">
                            <h3>Room number: {{ room.numberOfRoom }} <span class="badge badge-primary">{{ room.room_type }}</span></h3>
                            <div class="flex gap-2 text-base mb-2 font-medium text-main">
                                <i class="fi fi-rr-money-bill-wave"></i>
                                <p>{{ room.price.toLocaleString() }} bath</p>
                            </div>
                            <div class="flex gap-2 text-base mb-2 font-medium text-main">
                                <i class="fi fi-rr-bed"></i>
                                <p>{{ room.numberOfBed }} bed</p>
                            </div>
                            <div class="flex gap-2 text-base mb-2 font-medium text-main">
                                <i class="fi fi-rr-user"></i>
                                <p>{{ sumPeople(room.numberOfBed,room.bed_type) }} people</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-flush p-10 d-flex">
                <div class="d-flex gap-10 justify-content-center">
                    <button class="btn btn-primary btn-sm" type="button" @click="check(1)">Accept</button>
                    <button class="btn btn-danger btn-sm" type="button" @click="check(2)">Reject</button>
                </div>
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
    import moment from 'moment';
    import axios from 'axios';
    import Notiflix from 'notiflix';
    import Swal from 'sweetalert2'
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/swiper-bundle.css';
    import 'swiper/css/pagination';
    import { Pagination, Autoplay, Keyboard } from 'swiper/modules';

        export default {
            components: {
                Swiper,
                SwiperSlide
            },
            data(){

                return  {
                    user: {
                        email: ''
                    },
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
                    photos: null,
                    hotel: {
                        hotelName: '',
                        province: '',
                        amphures: '',
                        address: '',
                        about: ''
                    },
                    room: null
                }
            },
            props:{
                hotelRoute: String,
                csrfToken: String
            },
            methods: {
                getHotel(){
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const id = urlParams.get('id')

                    axios.get('/admin/api/get/infomation/hotel?id='+id).then(response => {
                        this.photos = response.data.message.image
                        this.hotel = response.data.message.hotel
                        this.hotel.near = JSON.parse(this.hotel.near)
                        this.room = JSON.stringify(response.data.message.room)
                        this.room = JSON.parse(this.room)
                    }).catch(error => {
                        window.location.href = error.response.data.url
                    })

                },
                sumPeople(value,bed){
                    return parseInt(value) * parseInt(bed);
                },
                check(value){
                    const message = (value == 1) ? 'Do you want to accept?' : 'Do you want to reject?';
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const id = urlParams.get('id')
                    Notiflix.Confirm.show(
                        'Warning',
                        message,
                        'Okay',
                        'Cancel',
                        () => {
                            axios.post('/admin/api/check/hotel',
                                {
                                    id: id,
                                    value: value
                                },
                                {
                                    headers:{
                                        'X-CSRF-TOKEN' : this.csrfToken
                                    }
                                }
                            ).then(response => {
                                Notiflix.Report.success(
                                    'SUCCESS',
                                    response.data.message,
                                    'okay',
                                    () => {
                                        window.location.href = response.data.url
                                    }
                                )
                            })
                        }
                    )
                },
                logout(){
                    Notiflix.Confirm.show(
                        'Warning',
                        'Do you want to logout?',
                        'Okay',
                        'Cancel',
                        () => {
                            axios.post('/admin/api/logout',
                                {
                                    headers:{
                                        'X-CSRF-TOKEN' : this.csrfToken
                                    }
                                }
                            ).then(response => {
                                Notiflix.Report.success(
                                    'SUCCESS',
                                    'Logout successful!',
                                    'Okay',
                                    () => {
                                        window.location.href = response.data.url
                                    }
                                )
                            })
                        }
                    )
                }
            },
            watch: {

            },
            computed: {

            },
            async mounted() {

                await axios.get('/admin/api/get/info').then(response => {
                    this.user = response.data.message
                })

                await this.getHotel()

            }
        }
    </script>

