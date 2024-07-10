<template>
    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" :style="{backgroundImage: 'url('+background+')'}">

            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

                <a href="" class="mb-12">
                    <img alt="Logo" :src="logo" class="h-60px" />
                </a>


                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" enctype="multipart/form-data" ref="repassword" @submit.prevent="submitForm">

                        <div class="text-center mb-10">

                            <h1 class="text-dark mb-3">Forgot password?</h1>

                        </div>


                        <div class="fv-row mb-10">

                            <label class="form-label fs-6 fw-bold text-dark" for="email">Email</label>


                            <input class="form-control form-control-lg form-control-solid" id="email" type="text" name="email" autocomplete="off" />

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

        export default {
            data(){

                return  {

                }
            },
            props:{
                logo: String,
                background: String,
                csrfToken: String,
            },
            methods: {
                submitForm() {

                    Notiflix.Loading.pulse('Loading...');

                    const formData = new FormData(this.$refs.repassword);

                    axios.post('/api/check/new/password', formData, {
                        headers: {
                            'X-CSRF-TOKEN': this.csrfToken,
                            'Content-Type':'multipart/form-data'
                        }
                    })
                   .then(response => {

                        Notiflix.Loading.remove();

                        Notiflix.Notify.success('Password reset link has been sent to your email address.');

                    })
                   .catch(error => {
                        Notiflix.Loading.remove();
                        Notiflix.Notify.failure(error.response.data.message);
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
