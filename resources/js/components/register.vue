<template>
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sigma-1/14.png)">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="#" class="mb-12">
                    <img alt="Logo" :src="logo" class="h-60px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate"  id="kt_sign_up_form" ref="signup" @submit.prevent="signup">
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Create an Account</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-semibold fs-4">Already have an account?
                            <a :href="loginRoute" class="link-primary fw-bold">Sign in here</a></div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">First Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="fname" autocomplete="off" />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">Last Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="lname" autocomplete="off" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bold text-dark fs-6">Gender</label>
                            <select class="form-select form-select-lg form-select-solid" name="gender" aria-label="Select example">
                                <option value="men">MEN</option>
                                <option value="women">WOMEN</option>
                                <option value="other">OTHER</option>
                                <option value="" selected hidden>Gender</option>
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bold text-dark fs-6">Citizen ID</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="CitizenID" autocomplete="off" minlength="13" maxlength="13" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bold text-dark fs-6">Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="tel" autocomplete="off" />
                        </div>
                        <!--end::Input group-->
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bold text-dark fs-6">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-7 d-none">
                            <label class="form-label fw-bold text-dark fs-6">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="user" value="member" autocomplete="off" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bold text-dark fs-6">Password</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-2"></i>
                                        <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <!--end::Input wrapper-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bold text-dark fs-6">Confirm Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                <span class="form-check-label fw-semibold text-gray-700 fs-6">I Agree
                                <a href="#" class="ms-1 link-primary">Terms and conditions</a>.</span>
                            </label>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
</template>

<script>
    import moment from 'moment';
    import axios from 'axios';
    import Notiflix from 'notiflix';
    import Swal from 'sweetalert2'
    import Echo from 'laravel-echo';
    import Pusher from 'pusher-js';

        export default {
            data(){

                return  {

                }
            },
            props:{
                logo: String,
                background: String,
                csrfToken: String,
                loginRoute: String
            },
            methods: {
                signup(){

                    const formData = new FormData(this.$refs.signup)

                    axios.post('/auth/register/store',formData,
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
                                window.location = response.data.url
                            }
                        )
                    }).catch(error => {
                        Notiflix.Report.failure(
                            'Failed',
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
            mounted() {

            }
        }
    </script>
