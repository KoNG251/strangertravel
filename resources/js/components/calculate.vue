<template>
    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" :style="{backgroundImage: 'url('+background+')'}">



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
            },
            methods: {

            },
            watch: {

            },
            computed: {

            },
            mounted() {

            }
        }
    </script>
