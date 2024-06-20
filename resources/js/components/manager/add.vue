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
                <h1 class="text-2xl text-main font-bold mb-5">ADD HOTEL DETAILS</h1>
                <form action="post" method="post" @submit.prevent="submitForm">
                    <div class="row fv-row mb-7">
                        <div class="col-xl-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" v-model="name" placeholder="hotel name"/>
                                <label for="name">Hotel name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-6">
                            <div class="form-floating">
                                <select class="form-select" v-model="province" id="province">
                                    <option selected hidden value="">open to select province</option>
                                    <option v-for="item in provinceList" :key="item.id" :value="item.id"> {{ item.name_th }} </option>
                                </select>
                                <label for="province">Province</label>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-floating">
                                <select class="form-select" v-model="amphures" id="amphures">
                                    <option selected hidden value="">open to select amphures</option>
                                    <option v-for="item in filteredItems" :key="item.id" :value="item.name_th"> {{ item.name_th }} </option>
                                </select>
                                <label for="amphures">Amphures</label>
                            </div>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="address" v-model="address" id="address" style="height: 80px"></textarea>
                                <label for="address">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="about" v-model="about" id="about" style="height: 80px"></textarea>
                                <label for="about">About</label>
                            </div>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-10">
                            <div class="form-floating mb-7">
                                <input type="text" class="form-control" v-model="near" id="near" placeholder="near"/>
                                <label for="near">Near</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <button class="btn btn-dark w-full" type="button" @click="pushArray" style="height: 50.75px">Add near</button>
                        </div>
                        <div class="col-xl-12 flex flex-wrap gap-3">
                            <span class="badge badge-primary cursor-pointer" v-for="(item, index) in nearList" :key="index" @click="removeArray(index)">{{item}}</span>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-10">
                            <div class="form-floating mb-7">
                                <input type="text" class="form-control" v-model="facilitie" id="facilitie" placeholder="facilitie"/>
                                <label for="near">facilities</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <button class="btn btn-dark w-full" type="button" @click="pushFacilities" style="height: 50.75px">facilitie</button>
                        </div>
                        <div class="col-xl-12 flex flex-wrap gap-3">
                            <span class="badge badge-primary cursor-pointer" v-for="(item, index) in facilities" :key="index" @click="removeFacilities(index)">{{item}}</span>
                        </div>
                    </div>
                    <button class="btn btn-primary">SUBMIT</button>
                </form>
            </div>

        </div>
        <!--end::Container-->
    </div>
</template>

<style>
    .password{
        width: 350px;
    }
</style>

<script>
    import moment from 'moment';
    import axios from 'axios';
    import Notiflix from 'notiflix';
    import Swal from 'sweetalert2'
    import flatpickr from "flatpickr";

        export default {
            data(){

                return  {
                    user: {
                        email: '',
                    },
                    name: '',
                    near: '',
                    nearList: [],
                    address: '',
                    province: '',
                    provinceList: [],
                    amphures: '',
                    amphuresList: [],
                    about: '',
                    facilitie: '',
                    facilities: []
                }
            },
            props:{
                csrfToken: String,
                provinceRoute: String,
                amphuresRoute: String
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
                pushArray(){
                    if(this.near != "" || this.near == null){
                        this.nearList.push(this.near);
                        this.near = '';
                    }
                },
                removeArray(index){
                    this.nearList.splice(index, 1);
                },
                submitForm(){
                    axios.post('/manager/api/store/details',
                        {
                            name: this.name,
                            province: this.province,
                            amphures: this.amphures,
                            address: this.address,
                            about: this.about,
                            near: this.nearList,
                            facilities: this.facilities
                        },
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Notify.success('Add successfully');
                        setTimeout(() => {
                             window.location.href = `/manager/view/add/picture?id=${response.data.message.id}`
                        },200);
                    }).catch(error => {
                        console.log(error)
                        Notiflix.Report.failure(
                            'Error',
                            error.response.data.message,
                            'Okay',
                        )
                    });
                },
                pushFacilities() {
                    if (this.facilitie != '') {
                        this.facilities.push(this.facilitie);
                        this.facilitie = '';
                    }
                },
                removeFacilities(index){
                    this.facilities.splice(index, 1);
                }
            },
            watch: {

            },
            computed: {
                filteredItems(){
                    return this.amphuresList.filter(item => item.province_id == this.province);
                }
            },
            async mounted() {

                await axios.get('/manager/api/get/info').then(response => {
                    this.user = response.data.message
                })
;
                await axios.get(this.provinceRoute).then(res => {
                    this.provinceList = res.data;
                });

                await axios.get(this.amphuresRoute).then(res => {
                    this.amphuresList = res.data;
                });

            }
        }
    </script>

