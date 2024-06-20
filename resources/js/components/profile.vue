<template>

<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto text-sidebar bg-gray-50">
      <a :href="indexRoute" class="flex items-center ps-2.5 mb-5">
         <img :src="logoPrimary" class="h-6 me-3 sm:h-7" alt="StrangerTravel logo" />
         <span class="self-center text-xl font-semibold whitespace-nowrap">StrangerTravel</span>
      </a>
      <ul class="space-y-2 font-medium">
        <li>
            <a href="#" class="flex items-center p-2 rounded-lg group text-sidebar" style="color: #0B1E3F;">
                <i class="fa-solid fa-user"></i>
                <span class="ms-3">Profile</span>
            </a>
        </li>
         <li>
            <a :href="authRoute" class="flex items-center p-2 rounded-lg group text-sidebar">
                <i class="fa-solid fa-fingerprint"></i>
                <span class="ms-3">Authentication</span>
            </a>
         </li>
         <li>
            <a :href="authRoute" class="flex items-center p-2 rounded-lg group text-sidebar">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span class="ms-3">Booking history</span>
            </a>
         </li>
        <li>
            <a :href="indexRoute" class="flex items-center p-2 rounded-lg group text-sidebar">
                <i class="fa-solid fa-house"></i>
                <span class="ms-3">Home</span>
            </a>
        </li>
         <li>
            <div class="flex items-center p-2 rounded-lg group text-sidebar cursor-pointer" @click="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="ms-3">Logout</span>
            </div>
         </li>

      </ul>
   </div>
</aside>

<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg  main">
        <h1 class="text-3xl text-main">Profiles</h1>
        <div class="mb-4 border-b">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="detail-tab" data-tabs-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="false">My details</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="manage-tab" data-tabs-target="#manage" type="button" role="tab" aria-controls="manage" aria-selected="false">Manage account</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="p-4 sm:ml-64">
    <div id="default-tab-content">

            <!-- detail -->
            <div class="hidden" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <div class="p-7 rounded-lg border-tab grid grid-cols-1 md:grid-cols-4">
                    <div class="col-span-1 mb-10 md:mb-0">
                        <h3 class="text-2xl text-main">Basic details</h3>
                    </div>
                    <div class="col-span-1 sm:col-span-3">
                        <div class="profile-picture flex flex-col md:flex-row items-center md:items-start w-full md:h-40">
                            <label class="rounded-full cursor-pointer" for="inputPicture">
                                <div :style="{ backgroundImage: 'url(' + pictureRoute + '/' + userPicture + ')' }" style="width: 150px; height: 150px; background-size: cover; background-position: center; border-radius:100%;" ></div>
                            </label>
                        </div>
                        <form  @submit.prevent="submitChangePicture" id="form-change-picture" enctype="multipart/form-data">
                            <input type="file" @change="onFileChange" ref="fileInput" class="hidden" id="inputPicture">
                            <button type="submit" ref="submitButton" class="hidden"></button>
                        </form>
                        <div class="box-detail">
                            <form @submit.prevent="submitDetailForm" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="relative detail-input mt-4">
                                    <input v-model="localFirstname" type="text" id="firstname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                                    <label for="firstname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-950 peer-focus:dark:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">First name</label>
                                </div>
                                <div class="relative detail-input mt-4">
                                    <input v-model="localLastname" type="text" id="lastname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                                    <label for="lastname" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-950 peer-focus:dark:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Last name</label>
                                </div>
                                <div class="relative detail-input mt-4">
                                    <input v-model="localBirthDate" type="date" id="birthDate" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-950 peer" placeholder=" " />
                                    <label for="birthDate" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-950 peer-focus:dark:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Birth date</label>
                                </div>
                                <div class="relative detail-input mt-4">
                                    <select v-model="localGender" id="gender" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-950 peer" >
                                        <option selected hidden v-if="localGender != ''" :value="localGender">{{ localGender }} </option>
                                        <option value="men">men</option>
                                        <option value="women">women</option>
                                        <option value="other">other</option>
                                    </select>
                                    <label for="gender" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-950 peer-focus:dark:text-blue-950 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">gender</label>
                                </div>
                                <button type="submit" class="md:col-span-2 btn-detail-submit rounded-xl">Confirm</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- manage -->
            <div class="hidden" id="manage" role="tabpanel" aria-labelledby="manage-tab">
                <div class="p-7 rounded-lg border-tab">
                    <div class="col-span-1 mb-10 md:mb-0">
                        <h3 class="text-2xl text-main">Manage account</h3>
                    </div>

                    <h4 class="text-xl text-bold text-main mt-6">Email Address</h4>
                    <p class="text-main">Your email address is <b>{{ email }}</b></p>

                    <div class="grid grid-cols-2 mt-6">
                        <h4 class="text-xl text-bold text-main">Manage password</h4>
                        <p class="text-blue-500 underline cursor-pointer" @click="clickShowHide">{{ showpassword ? 'hide' : 'show' }}</p>
                        <form class="col-span-2 mt-7" @submit.prevent="savePassword" enctype="multipart/form-data" :style="{display: showpassword ? 'block' : 'none' }">
                            <div class="flex flex-col md:flex-row gap-y-10 md:gap-x-10">
                                <div class="relative">
                                    <input v-model="newpass" type="password" id="newpassword" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="newpassword" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">New password</label>
                                </div>
                                <div class="relative">
                                    <input v-model="current" type="password" id="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Current password</label>
                                </div>
                            </div>
                            <button class="btn-submit mt-7 w-52 h-11 rounded-md">save password</button>
                        </form>
                    </div>

                    <h4 class="text-xl text-bold text-main mt-7">Delete account</h4>
                    <p class="text-main">Would you like to delete you account?</p>
                    <button class="btn-delete mt-7 w-52 h-11 rounded-md" @click="deleteAccount">Delete account</button>
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

    export default {


        data(){
            const picture = localStorage.getItem('userPicture');
            return  {
                userPicture: picture,
                pictureName: null,
                localFirstname: this.firstname,
                localLastname: this.lastname,
                localGender: this.gender,
                localBirthDate: moment(this.birthdate).format('YYYY-MM-DD'),
                changeEmail: false,
                newpass: '',
                current: '',
                showpassword: false,
            }
        },
        props:{
            logoPrimary: String,
            indexRoute: String,
            firstname: String,
            lastname: String,
            pictureRoute: String,
            updatePictureRoute: String,
            csrfToken: String,
            gender: String,
            updateDetailRoute: String,
            birthdate: String,
            email: String,
            updatePasswordRoute: String,
            deleteAccountRoute: String,
            logoutRoute: String,
            authRoute:String
        },
        methods: {
            onFileChange(e) {
                const file = e.target.files[0];
                if (!file) {
                this.pictureName = null;
                return;
                }
                this.pictureName = file.name;

                this.$refs.submitButton.click();
            },
            submitChangePicture(){
                const formData = new FormData();
                formData.append('image', this.$refs.fileInput.files[0]);

                console.log(formData)

                axios.post(this.updatePictureRoute, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                }).then(response => {

                    console.log(response.data.data.path)
                    localStorage.setItem('userPicture',response.data.data.path)
                    Notiflix.Notify.success('Update Successfully!', {
                        timeout: 1923,
                        clickToClose: true
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1925);
                }).catch(error => {
                    Notiflix.Notify.failure('Update not success!', {
                        timeout: 1923,
                        clickToClose: true
                    });
                });
            },
            submitDetailForm(){
                axios.post(this.updateDetailRoute,
                {
                    firstname: this.localFirstname,
                    lastname: this.localLastname,
                    gender: this.localGender,
                    birthdate: this.localBirthDate
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                }).then(response=>{

                    console.log(response);

                    Notiflix.Notify.success('Update Successfully!', {
                        timeout: 1923,
                        clickToClose: true
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1925);
                }).catch(error=>{
                    Notiflix.Notify.failure('Update not success!', {
                        timeout: 1923,
                        clickToClose: true
                    });
                });
            },
            savePassword(){
                axios.post(this.updatePasswordRoute,
                {
                    new: this.newpass,
                    current: this.current
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                })
                .then(response=>{
                    Notiflix.Notify.success(response.data.message, {
                        timeout: 1923,
                        clickToClose: true
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1925);
                })
                .catch(error=>{
                    Notiflix.Notify.failure(error.response.data.message, {
                        timeout: 1923,
                        clickToClose: true
                    });
                })
            },
            deleteAccount(){
                Swal.fire({
                title: "Are you sure?",
                text: "Do you want to delete account?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "delete"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.patch(this.deleteAccountRoute,
                        {
                            headers: {
                            'X-CSRF-TOKEN': this.csrfToken
                            }
                        }).then(res => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'delete seccess',
                            }).then(() => {
                                localStorage.clear();
                                this.userPicture = 'null';
                                window.location = this.indexRoute;
                            });
                        });
                }
                });
            },
            clickShowHide(){
                this.showpassword = !this.showpassword
            },
            logout(){
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(this.logoutRoute,
                        {
                            headers: {
                            'X-CSRF-TOKEN': this.csrfToken
                            }
                        }).then(res => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Logout seccess',
                            }).then(() => {
                                localStorage.clear();
                                this.userPicture = 'null';
                                window.location = this.indexRoute;
                            });
                        });
                }
                });
        }

        },
        watch: {

        },
        computed: {

        }
    }
</script>

