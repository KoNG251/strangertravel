<template>
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="text-dark fw-bold my-1 fs-2">Account</h1>
                <!--end::Heading-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Account</li>
                    <li class="breadcrumb-item text-dark">Authentication</li>
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
            <!--begin::Card-->
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('assets/media/illustrations/sigma-1/4.png')">
                <!--begin::Card header-->
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <!--begin::Icon-->
                        <div class="symbol symbol-circle me-5">
                            <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                                <i class="ki-duotone ki-abstract-47 fs-2x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <h2 class="mb-1">Authentication</h2>
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
                                <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#edit">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#manage">Manage Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#verify">Verify</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                    </div>
                    <!--begin::Navs-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Card-->
            <div class="card card-flush p-10">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="edit" role="tabpanel">
                        <h3 class="text-2xl text-main">Basic details</h3>

                        <form @submit.prevent="submitDetailForm" ref="submitDetailForm" enctype="multipart/form-data">
                            <div class="row fv-row mb-7">
                                <div class="col-xl-6">
                                    <div class="form-floating mb-7">
                                        <input type="text" class="form-control" id="fname" name="fname" :value="user.fname"/>
                                        <label for="fname">First name</label>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-floating mb-7">
                                        <input type="text" class="form-control" id="lname" name="lname" :value="user.lname"/>
                                        <label for="lname">Last name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row fv-row mb-7">
                                <div class="col-xl-6">
                                    <div class="form-floating mb-7">
                                        <input class="form-control" placeholder="Birth date" id="kt_datepicker_1" ref="datepicker" name="birthdate" :value="user.birthdate" />
                                        <label for="kt_datepicker_1">Birth date</label>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="gender" aria-label="Floating label select example">
                                            <option value="men">men</option>
                                            <option value="women">women</option>
                                            <option value="other">other</option>
                                            <option :value="user.gender" selected hidden>{{ user.gender }} (selected)</option>
                                        </select>
                                        <label for="floatingSelect">Gender</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
                        </form>
                    </div>
                    <!-- manage -->
                    <div class="tab-pane fade" id="manage" role="tabpanel">
                        <h3 class="text-2xl text-main">Manage account</h3>
                        <h4 class="text-xl text-bold text-main mt-6">Email Address</h4>
                        <p class="text-main">Your email address is <b>{{ user.email }}</b></p>
                        <h4 class="text-xl text-bold text-main">Manage password</h4>
                        <form class="" @submit.prevent="savePassword" ref="savePassword" enctype="multipart/form-data">
                            <div class="form-floating mb-7">
                                <input type="password" class="form-control password" id="current" name="current" />
                                <label for="current">Current password</label>
                            </div>
                            <div class="form-floating mb-7">
                                <input type="password" class="form-control password" id="new" name="password" />
                                <label for="new">New password</label>
                            </div>
                            <div class="form-floating mb-7">
                                <input type="password" class="form-control password" id="confirm" name="password_confirmation" />
                                <label for="confirm">Confirm password</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="verify" role="tabpanel">
                        <div class="p-7 rounded-lg border-tab">
                                <h4 class="text-xl text-bold text-main mt-6">Email Address</h4>
                                <p class="text-main mb-6">Your email address is <b>{{ user.email }}</b></p>
                                <a :href="sendEmailRoute" v-if="user.otp_verify != 1">
                                    <button class="btn btn-primary">
                                        send-otp
                                    </button>
                                </a>
                        </div>
                        <div class="p-7 rounded-lg border-tab">
                                <h4 class="text-xl text-bold text-main mt-6">Phone number</h4>
                                <p class="text-main mb-6">Your number is <b>{{ user.tel }}</b></p>
                                <a :href="sendPhoneRoute" v-if="user.email_verify != 1">
                                    <button class="btn btn-primary">
                                        send-otp
                                    </button>
                                </a>
                        </div>
                    </div>
                </div>
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
                        userPicturePath: null,
                        fname: '',
                        lname: '',
                        tel: '',
                        gender: '',
                        birthdate:'',
                        otp_verify: 0,
                        email_verify: 0,
                    },
                    userList: null,
                    page: 1,
                    nextPage: '',
                    prevPage: '',
                    total: 1,
                    showpassword: false,
                }
            },
            props:{
                csrfToken: String,
                sendEmailRoute: String,
                sendPhoneRoute: String
            },
            methods: {
                logout(){
                    Notiflix.Confirm.show(
                        'Warning',
                        'Do you want to logout?',
                        'Okay',
                        'Cancel',
                        () => {
                            axios.post('/auth/logout/self',
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
                initDatePicker() {
                    flatpickr(this.$refs.datepicker, {
                        maxDate: new Date()
                    });
                },
                submitDetailForm(){
                    const formData = new FormData(this.$refs.submitDetailForm)

                    axios.post('/auth/update/details',formData,
                        {
                            headers:{
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Report.success(
                            'SUCCESS',
                            response.data.message,
                            'Okay',
                            () => {
                                window.location.reload()
                            }
                        )
                    }).catch(error => {
                        Notiflix.Report.failure(
                            'fail',
                            error.response.data.message,
                            'Okay'
                        )
                    })
                },
                savePassword() {
                    const formData = new FormData(this.$refs.savePassword)
                    axios.post('/auth/update/password',formData,
                        {
                            headers:{
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Report.success(
                            'SUCCESS',
                            response.data.message,
                            'Okay',
                            () => {
                                window.location.reload()
                            }
                        )
                    }).catch(error => {
                        Notiflix.Report.failure(
                            'fail',
                            error.response.data.message,
                            'Okay'
                        )
                    })
                }
            },
            watch: {

            },
            computed: {

            },
            async mounted() {

                await axios.get('/api/get/info').then(response => {
                    this.user = response.data.message
                })

                this.initDatePicker();


            }
        }
    </script>

