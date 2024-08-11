<template>
<div class="h-screen display">
    <div class="w-full p-2 black-drop nav-chat rounded-full flex items-center justify-between mb-3">
        <img :src="logo" alt="" class="logo">
        <div class="text-white flex items-center gap-7">
            <a href="#">
                <div class="link-btn rounded-full text-black text-center hover:bg-slate-300 duration-300 ease-in-out">CHAT</div>
            </a>
            <a :href="indexRoute">
                <div class="rounded-full text-white text-center">HOME</div>
            </a>
        </div>
        <div class="flex text-white gap-4 pe-5">
            <button class="text-2xl cursor-pointer" data-modal-target="join-modal" data-modal-toggle="join-modal">
                <i class="fa-solid fa-users-line"></i>
            </button>
            <button  class="text-2xl cursor-pointer" data-modal-target="create-modal" data-modal-toggle="create-modal">
                <i class="fa-solid fa-circle-plus"></i>
            </button >
        </div>
    </div>
    <div class="chat-grid flex-grow grid grid-cols-5 gap-1 w-full">
        <div class="col-span-1 black-drop rounded-lg p-3 chat-list overflow-y-scroll">
            <h3 class="text-center text-white text-2xl font-bold">GROUP</h3>
            <div v-for="chat in chatList" :key="chat" :class="['w-full p-1 flex items-center gap-4 hover:bg-blue-100 rounded-full mb-3 duration-300 ease-in-out cursor-pointer',{'bg-blue-600': id === chat.id}]" @click="selectChat(chat)">
                <div class="profile-group rounded-full w-14 h-14 bg-white" :style="{ backgroundImage: 'url(' + chatGroup + '/' + chat.picture_file + ')' }"></div>
                <h1 class="text-white text-md">{{ chat.group_name }}</h1>
            </div>
        </div>
        <div class="col-span-3 black-drop rounded-lg p-3 duration-150 ease-in-out relative" v-if="id !== null">
            <div class="w-full h-full">
                <div class="h-28">
                    <div class="flex items-center gap-3">
                        <div class="profile-group rounded-full w-14 h-14 bg-white" :style="{ backgroundImage: 'url(' + chatGroup + '/' + picture_file + ')' }"></div>
                        <h1 class="text-white text-md">{{ group_name }}</h1>
                    </div>
                </div>
                <div class="chat-body w-full relative" ref="chatBody">
                    <div v-for="message in messageList" :key="message.id" :class="message.sender_id == userId ? 'chat-sender flex justify-end mb-10' : 'chat-receiver flex justify-start mb-10'">
                        <div :class="message.sender_id == userId ? 'flex flex-col items-end' : 'flex flex-col items-start'">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-full bg-blue-400 profile" v-if="message.sender_id != userId" :style="{backgroundImage: 'url('+profileRoute+'/'+message.userPicturePath+')'}"></div>
                                <div :class="message.sender_id == userId ? 'me-3 text-white' : 'ms-3 text-white'">
                                    <h1>{{ message.fname+' '+message.lname }}</h1>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-blue-400 profile" v-if="message.sender_id == userId" :style="{backgroundImage: 'url('+profileRoute+'/'+message.userPicturePath+')'}"></div>
                            </div>
                            <div :class="message.sender_id == userId ? 'text-end py-1 px-3 message-sender bg-blue-600 font-light text-sm rounded-full break-words overflow-hidden min-w-20 max-w-96 text-white' : 'text-start py-1 px-3 message-receiver bg-slate-600 font-light text-sm rounded-full break-words overflow-hidden min-w-20 max-w-96 text-white'">
                                {{ message.body }}
                            </div>
                        </div>
                    </div>
                </div>
                <form class="chat-footer w-full absolute bottom-0 rounded-lg px-4 py-3" @submit.prevent="sendMessage">
                    <div class="w-full h-full flex items-center relative">
                        <input type="text" v-model="message" placeholder="Message..." class="ps-4 message-input text-sm font-light focus:ring-0 h-full w-full rounded-full">
                        <button class="absolute right-5 text-xl hover:text-blue-300"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="grid place-items-center col-span-3 black-drop rounded-lg p-3 duration-150 ease-in-out" v-else>
            <h1 class="text-white text-3xl">SELECT YOUR GROUP</h1>
        </div>
        <div class="col-span-1 black-drop rounded-lg p-3" v-if="id !== null">
            <h3 class="text-center text-white text-2xl font-bold">MEMBER</h3>

            <div class="member-card overflow-y-scroll">
                <div class="mb-3 flex items-center justify-between" v-for="member in memberList" :key="member.id">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-500 rounded-full" :style="{backgroundImage: 'url('+profileRoute+'/'+member.userPicturePath+')'}"></div>
                        <h1 class="text-white text-md">{{ member.fname+' '+member.lname }}</h1>
                    </div>
                    <div class="flex items-center text-2xl text-red-500 hover:text-red-600 cursor-pointer" v-if="adminGroup == userId && userId != member.id">
                        <button @click="kickmember(id,member.groupId)">
                            <i class="fa-solid fa-user-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="w-full text-red-500 text-xl text-start hover:bg-red-500 p-3 hover:text-white duration-300 ease-in-out rounded-md" @click="leaveGroup(id)">
                <i class="fa-solid fa-right-from-bracket"></i> <span class="mx-3">Leave group</span>
            </button>
        </div>
    </div>
</div>
<!-- begin::create modal -->
<div id="create-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" @submit.prevent="createGroup" ref="createGroup">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create Group
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <input type="text" :value="userId" name="create_id" class="hidden">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Group profile</label>
                <input class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="small_size" name="picture_file" type="file">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="group_name">Group name</label>
                <input class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none" id="group_name" name="group_name" type="text">

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create</button>
                <button data-modal-hide="create-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancle</button>
            </div>
        </form>
    </div>
</div>
<!-- end::create modal -->
<!-- begin::join group -->
<div id="join-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Join Community
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="join-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 h-96 grid grid-cols-3 gap-3 overflow-y-scroll">
                <div class="cursor-pointer h-24" v-for="group in groupList" :key="group.id" @click="joinGroup(group.id)">
                    <div class="mx-auto w-16 h-16 rounded-full profile" :style="{backgroundImage: 'url(' + chatGroup + '/' + group.picture_file + ')' }"></div>
                    <p class="text-base text-center">{{ group.group_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end::join group -->
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
                    id: null,
                    message: '',
                    chat:null,
                    isModalCreateOpen: false,
                    chatList: null,
                    messageList: null,
                    picture_file: 'asd',
                    group_name: 'asd',
                    adminGroup : '',
                    groupList: [],
                    memberList: null
                }
            },
            props:{
                    logo: String,
                    chatRoute: String,
                    userId: String,
                    createChat: String,
                    csrfToken: String,
                    chatGroup: String,
                    pusherKey: String,
                    pusherCluster: String,
                    profileRoute: String,
                    indexRoute: String
            },
            methods: {
                selectChat(chat){
                    Notiflix.Loading.hourglass('may take a second')
                    this.id = chat.id
                    this.picture_file = chat.picture_file
                    this.group_name = chat.group_name
                    this.adminGroup = chat.create_id
                    axios.get('chat/api/get/message/'+chat.id)
                    .then(response =>{
                        this.messageList = JSON.stringify(response.data.message)
                        this.messageList = JSON.parse(this.messageList)
                        this.$nextTick(() => {
                            this.scrollToBottom();
                        });
                    })
                    axios.post('chat/api/member',{
                        id: chat.id,
                        header :{
                            'X-CSRF-TOKEN': this.csrfToken
                        }
                    }).then(response => {
                        this.memberList = response.data.message
                    })
                    this.listenToGroup(chat.id)
                    setTimeout(() => {
                        Notiflix.Loading.remove();
                    },1500)
                },
                sendMessage(){
                    Notiflix.Loading.hourglass("send message...")
                    if (this.message.trim() != '') {
                        axios.post('chat/api/send/message',
                            {
                                sender_id:this.userId,
                                group_id: this.id,
                                message: this.message
                            },
                            {
                                headers:{
                                    'X-CSRF-TOKEN' : this.csrfToken
                                }
                            }
                        ).then(response => {
                            Notiflix.Loading.remove()
                            this.message = ''
                            this.scrollToBottom()
                        }).catch(error => {
                            Notiflix.Loading.remove()
                            Notiflix.Notify.failure(error.response.data.message)
                            this.message = ''
                        });
                    }else{
                        Notiflix.Loading.remove()
                    }
                },
                createGroup(){
                    const formData = new FormData(this.$refs.createGroup)
                    axios.post(this.createChat,formData,
                        {
                            headers:{
                                'X-CSRF-TOKEN' : this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Report.success(
                            'Success',
                            response.data.message.message,
                            "Okay",
                            () => {
                                window.location.reload()
                            }
                        )
                    })
                },
                listenToGroup(groupId) {
                    if (this.echo) {
                        this.echo.leave(`group-chat-channel-${groupId}`);
                    }

                    this.echo = new Echo({
                        broadcaster: 'pusher',
                        key: this.pusherKey,
                        cluster: 'ap1',
                        wsHost: 'ws-ap1.pusher.com',
                        wsPort: 443,
                        wssPort: 443,
                        disableStats: true,
                        encrypted: true,
                    });

                    this.echo.channel(`group-chat-channel-${groupId}`)
                        .listen('.new-message', (e) => {
                            this.messageList.push(e);
                        });
                },
                scrollToBottom() {
                    const chatBody = this.$refs.chatBody;
                    if (chatBody) {
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }
                },
                joinGroup(id){
                    axios.post('/chat/api/join/group',
                        {
                            id: id
                        },
                        {
                            headers:{
                                "X-CSRF-TOKEN" : this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Report.success(
                            'Success',
                            response.data.message,
                            "Okay",
                            () => {
                                window.location.reload()
                            }
                        )
                    }).catch(error => {
                        console.log(error.response.data)
                    })
                },
                leaveGroup(id){
                    Notiflix.Confirm.show(
                        'Leave group?',
                        'Do you want to leave this group?',
                        'Leave',
                        'Cancel',
                        () => {
                            axios.post('/chat/api/leave/group',
                                {
                                    id: id
                                },
                                {
                                    headers:{
                                        "X-CSRF-TOKEN" : this.csrfToken
                                    }
                                }
                            ).then(response => {
                                Notiflix.Report.success(
                                    'Success',
                                    response.data.message,
                                    "Okay",
                                    () => {
                                        window.location.reload()
                                    }
                                )
                            })
                        }
                    );
                },
                kickmember(id,memberId){
                    Notiflix.Confirm.show(
                        'Kick member?',
                        'Do you want to kick this member?',
                        'Kick',
                        'Cancel',
                        () => {
                            axios.post('/chat/api/kick/member',
                            {
                                group_id: id,
                                member_id: memberId,
                                header: {
                                    'X-CSRF-TOKEN': this.csrfToken
                                }
                            }
                            ).then(response => {
                                Notiflix.Report.success(
                                    'Success',
                                    response.data.message,
                                    "Okay",
                                    () => {
                                        window.location.reload()
                                    }
                                )
                            }).catch(error => {
                                Notiflix.Report.failure(
                                    'Fail',
                                    error.response.data.message,
                                    "Okay"
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
            mounted() {

                axios.get('chat/api/get/chatlist')
                .then(response => {
                    this.chatList = JSON.stringify(response.data.message)
                    this.chatList = JSON.parse(this.chatList)
                })

                axios.get('chat/api/get/group')
                .then(response => {
                    this.groupList = response.data.message
                })

            }
        }
    </script>
