<template>
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="text-dark fw-bold my-1 fs-2">Dashboard</h1>
                <!--end::Heading-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-dark">Dashboard</li>
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
        <div class="container-xxl" id="kt_content_container">
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6 mb-md-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            <!--begin::Card widget 8-->
                            <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                    <!--begin::Statistics-->
                                    <div class="mb-4 px-9">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Value-->
                                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ count.all }}</span>
                                            <!--end::Value-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-400">Total User</span>
                                        <div class="d-flex gap-x-4 mt-5">
                                            <span class="badge badge-light-primary fs-base">
                                               {{ count.member }} member
                                            </span>
                                            <span class="badge badge-light-danger fs-base">
                                               {{ count.manager }} manager
                                            </span>
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <div id="kt_card_widget_7_chart" class="min-h-auto" style="height: 125px"></div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 8-->
                            <!--begin::Card widget 5-->
                            <div class="card card-flush h-md-50 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ group }}</span>
                                            <!--end::Amount-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Chat Group</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                            </div>
                            <!--end::Card widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            <!--begin::Card widget 9-->
                            <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                    <!--begin::Statistics-->
                                    <div class="mb-4 px-9">
                                        <!--begin::Statistics-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Value-->
                                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ booking }}</span>
                                            <!--end::Value-->
                                        </div>
                                        <!--end::Statistics-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-400">Total booking success</span>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 9-->
                            <!--begin::Card widget 7-->
                            <div class="card card-flush h-md-50 mb-xl-10">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ hotel }}</span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Hotel</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                            </div>
                            <!--end::Card widget 7-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <!--begin::Maps widget 1-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <canvas id="donutChart"></canvas>
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Maps widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <div class="col-12">
                <div class="card card-flush ">
                    <div class="card-header pt-8">
                        <h1>All user</h1>
                    </div>
                    <div class="px-8 table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" style="margin-bottom: 40px">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th class="min-w-250px">Name</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Role</th>
                                    <th class="w-125px"></th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr v-for="(user, index) in userList" :key="user.id">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ user.fname+' '+user.lname }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <span class="badge badge-light-primary" v-if="user.user == 'member'">{{ user.user }}</span>
                                        <span class="badge badge-light-danger" v-else>{{ user.user }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul :class="['pagination mb-3',{'d-none' : total == 1}]" style="margin-top: 25px">
                            <li :class="['page-item previous cursor-pointer',{'disabled' : page == 1}]" @click="fetchUser(page-1)"><a class="page-link"><i class="previous"></i></a></li>
                            <li :class="['page-item cursor-pointer',{ 'active': number == page  }]" v-for="number in total" :key="number" @click="fetchUser(number)"><a class="page-link">{{ number }}</a></li>
                            <li :class="['page-item next cursor-pointer',{'disabled' : page == total}]" @click="fetchUser(page+1)"><a  class="page-link"><i class="next"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import moment from 'moment';
    import axios from 'axios';
    import Notiflix from 'notiflix';
    import Swal from 'sweetalert2'
    import { Doughnut } from 'vue-chartjs';

        export default {
            data(){

                return  {
                    user: {
                        email: ''
                    },
                    count: {
                        all: 0,
                        member: 0,
                        manager: 0
                    },
                    group: 0,
                    booking: 0,
                    hotel: 0,
                    amount: 0,
                    userList: null,
                    page: 1,
                    nextPage: '',
                    prevPage: '',
                    total: 1
                }
            },
            props:{
                csrfToken: String
            },
            methods: {
                fetchUser(page){
                    axios.get('/admin/api/get/count/all/user?page='+page).then(response => {
                        this.userList = response.data.message.data
                        this.page = response.data.message.current_page
                        this.nextPage = response.data.message.next_page_url
                        this.prevPage = response.data.message.prev_page_url
                        this.total = response.data.message.last_page
                    })
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
                },
                renderDonutChart() {
                    const ctx = document.getElementById('donutChart').getContext('2d');
                    const chartData = {
                        labels: this.amount.map(item => item.hotel),
                        datasets: [{
                        backgroundColor: ['#2C5D9E', '#628acf', '#c9ecff', '#4AA0D5','#004774','#0B1E3F','#1e2d50','#38456a'],
                        data: this.amount.map(item => item.total_price)
                        }]
                    };

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: chartData,
                        options: {
                        responsive: true,
                        maintainAspectRatio: false
                        }
                    });
                }
            },
            watch: {

            },
            computed: {

            },
            async mounted() {

                Notiflix.Loading.hourglass('Loading...');

                await axios.get('/admin/api/get/info').then(response => {
                    this.user = response.data.message
                })

                await axios.get('/admin/api/get/count/user').then(response => {
                    this.count = response.data.message
                })

                await axios.get('/admin/api/get/count/group').then(response => {
                    this.group = response.data.message
                })

                await axios.get('/admin/api/get/count/booking').then(response => {
                    this.booking = response.data.message
                })

                await axios.get('/admin/api/get/count/hotel').then(response => {
                    this.hotel = response.data.message
                })

                await axios.get('/admin/api/get/count/amount').then(response => {
                    this.amount = response.data.message
                })

                await this.fetchUser(this.page)

                this.renderDonutChart();

                Notiflix.Loading.remove();

            }
        }
    </script>

