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
                    <li class="breadcrumb-item text-dark">Add hotel</li>
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

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">

            <div class="card p-10">

                <div class="flex justify-between mb-7">
                    <h1 class="text-2xl text-main font-bold mb-5">Manage room</h1>
                    <button type="button" @click="addRoom" class="btn btn-danger">Add room</button>
                </div>
                <form class="grid grid-cols-1 md:grid-cols-2 gap-4" @submit.prevent="storeRoom" ref="storeForm">
                    <div v-for="(room, index) in rooms" :key="index" class="border border-blue-950 rounded-md p-10">
                        <div class="d-flex justify-between mb-7">
                            <h1 class="text-dark">Room {{ index+1  }}</h1>
                            <button type="button" class="btn btn-danger btn-sm rounded-md" @click="popRoom(index)" :disabled="index == 0">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <div class="row fv-row">
                            <div class="col-xl-12 mb-7">
                                <div class="form-floating">
                                    <input class="form-control" type="text" v-model="room.type" :id="'type'+index"/>
                                    <label :for="'type'+index">Room categories</label>
                                </div>
                            </div>
                            <div class="col-xl-6 mb-7">
                                <div class="form-floating">
                                    <input class="form-control" type="number" v-model="room.price" :id="'price'+index"/>
                                    <label :for="'price'+index">Price</label>
                                </div>
                            </div>
                            <div class="col-xl-6 mb-7">
                                <div class="form-floating">
                                    <input class="form-control" type="number" v-model="room.numberOfBed" :id="'numberOfBed'+index"/>
                                    <label :for="'numberOfBed'+index">Number of bed</label>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-7">
                                <div class="form-floating">
                                    <select class="form-select" :id="'bedType'+index" v-model="room.bedType">
                                        <option value="1">single bed</option>
                                        <option value="2">extra-large double bed</option>
                                        <option value="" selected hidden>bed type</option>
                                    </select>
                                    <label :for="'bedType'+index">Bed type</label>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-7">
                                <div class="form-floating">
                                    <input class="form-control" type="number" v-model="room.quantity" :id="'quantity'+index"/>
                                    <label :for="'quantity'+index">room quantity</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2 text-center">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>

            </div>

        </div>
        <!--end::Container-->
    </div>
</template>

<style>

</style>

<script>
    import moment from 'moment';
    import axios from 'axios';
    import Notiflix from 'notiflix';
    import Swal from 'sweetalert2'

        export default {
            data(){

                return  {
                    user: {
                        email: '',
                    },
                    id: null,
                    rooms: [
                        {
                            quantity: 0,
                            type: '',
                            price: '',
                            numberOfBed: '',
                            bedType: ''
                        }
                    ]


                }
            },
            props:{
                csrfToken: String,
                storeRoomRoute: String,
            },
            methods: {
                logout(){
                    Notiflix.Confirm.show(
                        'Warning',
                        'Do you want to logout?',
                        'Okay',
                        'Cancel',
                        () => {
                            axios.post('/manager/api/logout',
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
                                        window.location = response.data.url
                                    }
                                )
                            })
                        }
                    )
                },
                addRoom(){
                    this.rooms.push({
                        quantity: 0,
                        type: '',
                        price: '',
                        numberOfBed: '',
                        bedType: '',
                    });
                },
                popRoom(index) {
                    this.rooms.pop(index);
                },
                storeRoom(){
                    Notiflix.Loading.hourglass('Store room')
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const id = urlParams.get('id')

                    axios.post(this.storeRoomRoute,
                        {
                            id: id,
                            room: this.rooms
                        },
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Loading.remove()
                        Notiflix.Report.success(
                            'ADD SUCCESS',
                            'you just add hotel successfully!',
                            'okay',
                            ()=>{
                                window.location = response.data.url;
                            }
                        )

                    }).catch(error => {
                        Notiflix.Loading.remove()
                        console.log(error.response.data)
                    })
                },


            },
            watch: {

            },
            computed: {
            },
            async mounted() {

                await axios.get('/manager/api/get/info').then(response => {
                    this.user = response.data.message
                });


            }
        }
    </script>

