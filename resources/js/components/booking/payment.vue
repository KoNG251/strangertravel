<template>
    <div class="w-full">
        <ol class="mx-auto flex justify-center items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg sm:p-4 sm:space-x-4 rtl:space-x-reverse">
            <li class="flex items-center text-blue-600">
                <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0">
                    1
                </span>
                Select <span class="hidden sm:inline-flex sm:ms-2">hotel</span>
                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                </svg>
            </li>
            <li class="flex items-center text-blue-600">
                <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0">
                    2
                </span>
                Fill <span class="hidden sm:inline-flex sm:ms-2">infomation</span>
                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                </svg>
            </li>
            <li class="flex items-center text-blue-600">
                <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0">
                    3
                </span>
                Payment
            </li>
        </ol>
    </div>

    <div class="display rounded-lg shadow-xl mx-auto mt-7 p-4 md:p-16 border border-gray-100">
        <p class="text-base font-light">Payment Method</p>
        <div class="flex gap-x-4 mb-5">
            <label for="credit"
            :class="['payment-method border border-g rounded-md flex justify-center items-center gap-x-2', { 'border-blue-500 ring-1': payment === 'credit' }]"
            >
                <input type="radio" name="payment" id="credit" class="hidden" v-model="payment" value="credit">
                <i class="fa-regular fa-credit-card"></i>
                <span>Credit Card</span>
            </label>
            <label for="pp"
            :class="['payment-method border border-g rounded-md flex justify-center items-center gap-x-2', { 'border-blue-500 ring-1': payment === 'promptpay' }]"
            @click="submitPromptPayPayment"
            >
                <input type="radio" name="payment" id="pp" class="hidden" v-model="payment" value="promptpay">
                <i class="fa-solid fa-qrcode"></i>
                <span>PromptPay</span>
            </label>
        </div>

        <form v-if="payment == 'credit'" @submit.prevent="submitPayment">
            <label for="card" class="text-md">Card number</label>
            <p class="text-gray-400 text-sm mb-3">Enter the 16-digit card number on the card</p>
            <input type="text" id="card" v-model="cardNumber" class="input-payment rounded-md w-96 focus:ring-0  mb-5" maxlength="16" minlength="16" placeholder="XXXX XXXX XXXX XXXX">
            <br><label for="name" class="text-md">Full name</label>
            <p class="text-gray-400 text-sm mb-3">Enter the name on the card</p>
            <input type="text" id="name" v-model="name" class="input-payment rounded-md w-96 focus:ring-0 mb-5" placeholder="Full name">
            <div class="flex gap-x-3">
                <div class="flex flex-col">
                    <label for="cvv" class="text-md">CVV</label>
                    <input type="text" id="cvv" v-model="cvvNumber" class="input-payment rounded-md w-32 focus:ring-0 mb-7" placeholder="CVV">
                </div>
                <div class="flex flex-col">
                    <label for="expiration" class="text-md">Expiration date</label>
                    <input type="text" id="expiration" v-model="expiration" class="input-payment rounded-md w-32 focus:ring-0 mb-7" placeholder="MM/YY">
                </div>
                <input type="hidden" name="omiseToken" id="omiseToken">
            </div>
            <div class="flex gap-x-3 items-center">
                <button type="submit" class="btnSubmit p-2 w-64 text-white rounded-lg duration-300 ease-in-out mt-7">PAY NOW</button>
                <a href="" class="text-gray-300 underline">Cancle and returns</a>
            </div>
        </form>
        <div v-else>
            <img :src="promptPayQRCode" alt="" class=" w-80">
        </div>
    </div>
</template>

<script>
import moment from "moment";
import axios from "axios";
import Notiflix from "notiflix";
import Swal from "sweetalert2";

export default {

    data() {

        const params = new URLSearchParams(window.location.search);

        const defaultId = params.get("id");
        const defaultPrice = params.get("price");

        return {
            bookingId: defaultId,
            price: defaultPrice,
            payment: 'credit',
            cardNumber: '',
            name:'',
            cvvNumber:'',
            expiration:'',
            omiseToken: '',
            promptPayQRCode: null
        };
    },
    props: {
        csrfToken: String,
        cardPayment: String,
        promptPay: String,
        successRoute: String
    },
    methods: {
        submitPayment() {

            Notiflix.Loading.pulse('It may take 1 minute.');

            if (!this.cardNumber || !this.name || !this.cvvNumber || !this.expiration) {
                Notiflix.Loading.remove();
                Notiflix.Notify.failure('Please fill in all required fields.');
                return;
            }

            const formattedExpiration = moment(this.expiration, 'MM/YY', true);
            if (!formattedExpiration.isValid()) {
                Notiflix.Loading.remove();
                Notiflix.Notify.failure('Please enter a valid expiration date (MM/YY).');
                return;
            }


            Omise.createToken('card', {
                name: this.name,
                number: this.cardNumber,
                expiration_month: formattedExpiration.month(),
                expiration_year: formattedExpiration.year(),
                security_code: this.cvvNumber
            }, (statusCode, response) => {
                if (statusCode === 200) {
                    this.omiseToken = response.id;
                    axios.post(this.cardPayment,
                        {
                            price: this.price,
                            bookingId: this.bookingId,
                            omiseToken: this.omiseToken
                        },
                        {
                            headers:{
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        }
                    ).then(response => {
                        Notiflix.Loading.remove();
                        Notiflix.Notify.success(response.data.message);

                        setTimeout(() => {
                             window.location.href = `${this.successRoute}`
                        }, 1925);
                    }).catch(error => {

                        Notiflix.Loading.remove();
                        Notiflix.Report.failure(
                            'Failure',
                            'do not pay as the same booking',
                            'Okay',
                            () => {
                                window.location.href = '/'
                            }
                        );

                    })
                } else {
                    Notiflix.Loading.remove();
                    Notiflix.Notify.failure('Payment tokenization failed. Please try again.');
                }
            });
        },
        async submitPromptPayPayment() {
            try {
                const response = await axios.post(this.promptPay,
                {
                    price: this.price
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                }
            ).then(response => {
                this.promptPayQRCode = response.data.qrCodeUrl
            })

            } catch (error) {
                console.error('Error generating PromptPay QR code:', error);
            }
        }
    },
    watch: {

    },
    computed: {

    },
    mounted() {
        Omise.setPublicKey('pkey_test_5zv6h44eyonp7c7uqwj');

    },
};
</script>
