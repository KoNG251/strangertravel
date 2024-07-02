<template>
    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" :style="{backgroundImage: 'url('+background+')'}">

            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

                <a href="" class="mb-12">
                    <img alt="Logo" :src="logo" class="h-60px" />
                </a>


                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" enctype="multipart/form-data" ref="signin" @submit.prevent="submitForm">

                        <div class="text-center mb-10">

                            <h1 class="text-dark mb-3">Sign In</h1>
                            <div class="text-gray-400 fw-semibold fs-4">
                                New Here?
                                <a :href="registerRoute" class="link-primary fw-bold">Create an Account</a>
                            </div>

                        </div>


                        <div class="fv-row mb-10">

                            <label class="form-label fs-6 fw-bold text-dark" for="email">Email</label>


                            <input class="form-control form-control-lg form-control-solid" id="email" type="text" name="email" autocomplete="off" />

                        </div>


                        <div class="fv-row mb-10">

                            <div class="d-flex flex-stack mb-2">

                                <label class="form-label fw-bold text-dark fs-6 mb-0" for="password">Password</label>

                            </div>


                            <input class="form-control form-control-lg form-control-solid" id="password" type="password" name="password" autocomplete="off" />

                        </div>


                        <div class="text-center">

                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>

                        </div>

                    </form>

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
                registerRoute: String
            },
            methods: {
                submitForm(){
                    const formData = new FormData(this.$refs.signin);

                    axios.post('/auth/login/checkdata',formData,
                        {
                            headers: {
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Report.success(
                            'Success',
                             response.data.message,
                            'Okay',
                            () => {
                                window.location.href = response.data.url
                            }
                        );
                    }).catch(error => {
                        Notiflix.Report.failure(
                            'Failed to login',
                             error.response.data.message,
                            'Okay'
                        );
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
