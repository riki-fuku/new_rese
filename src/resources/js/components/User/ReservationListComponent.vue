<template>

    <div>
        <div v-for="(reservationShop, index) in this.reservationShops" :class="{
            'bg-blue-700 text-white': reservationShop.status == '1',
            'bg-blue-400 text-white': reservationShop.status == '2',
            'bg-green-500 text-white': reservationShop.status == '3',
        }" class="mb-5 py-8 px-8 rounded-lg shadow-xl">
            <div class="flex justify-between">
                <div>
                    <div>
                        <i class="fas fa-clock fa-lg"></i>
                        <div class="inline ml-3">予約{{ index + 1 }}</div> <!-- 予約数を表示 -->
                        <div class="inline ml-3">{{ this.status[reservationShop.status].label }}</div>
                    </div>
                </div>

                <div>
                    <!-- 予約済のみ表示 -->
                    <div :class="{ 'hidden': reservationShop.status != '1' }">
                        <!-- QRコード提示 -->
                        <a :href="`/shop/qr/${reservationShop.id}`">
                            <i class="fas fa-qrcode fa-lg mr-3"></i>
                        </a>

                        <!-- 編集 -->
                        <a :href="`/shop/edit/${reservationShop.id}`">
                            <i class="fas fa-edit fa-lg mr-3"></i>
                        </a>

                        <!-- 削除 -->
                        <i class="fas fa-times-circle fa-lg"
                            @click="deleteReservationShop(reservationShop.id, reservationShop.shop.name)"></i>
                    </div>

                    <!-- 決済完了のみ表示 -->
                    <div :class="{ 'hidden': reservationShop.status != '3' }">
                        <i class="fas fa-star fa-lg"
                            @click="openRating(reservationShop.id, reservationShop.shop_id, reservationShop.user_id)"></i>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <table class="w-full text-left">
                    <tr>
                        <th class="w-1/3">Shop</th>
                        <td>{{ reservationShop.shop.name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ reservationShop.reservation_date }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ reservationShop.reservation_time }}</td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>{{ reservationShop.party_size }}人</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- 評価モーダル -->
    <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen">
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- モーダルの内容 -->
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        評価
                    </h3>
                    <div class="mx-auto w-1/2 flex place-content-evenly">
                        <div v-for="i in 5" :key="i" class="inline-block">
                            <input type="radio" :id="`rating${i}`" name="rating" :value="i" class="hidden" />
                            <label :for="`rating${i}`" @click="changeRating(i)"
                                :class="{ 'text-yellow-300': i <= rating }">
                                <i class="fas fa-star fa-2x"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showModal = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        閉じる
                    </button>
                    <button @click="submitRating()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        送信
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- 評価モーダルここまで -->

</template>

<script>
import axios from 'axios';

export default {
    props: {
        status: Object
    },
    data() {
        return {
            reservationShops: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            showModal: false,
            rating: 0,
            shopReservationId: null,
            shopId: null,
            userId: null
        }
    },
    methods: {
        getReservations() {
            axios.get('/api/reservations').then(response => {
                this.reservationShops = response.data;
            });
        },
        deleteReservationShop(shopReservationId, reservationName) {
            if (confirm(`${reservationName}の予約をキャンセルしますか？`)) {
                axios.delete(`/api/reservations/${shopReservationId}`, {
                    headers: {
                        'id': shopReservationId,
                        'X-CSRF-TOKEN': this.csrf
                    }
                }).then(response => {
                    this.getReservations();
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        openRating(shopReservationId, shopId, userId) {
            this.rating = 0;
            this.shopReservationId = shopReservationId;
            this.shopId = shopId;
            this.userId = userId;
            this.showModal = true;
        },
        changeRating(ratingNumber) {
            this.rating = ratingNumber;
        },
        submitRating() {
            axios.post('/api/ratings', {
                rating: this.rating,
                reservation_id: this.shopReservationId,
                shop_id: this.shopId,
                user_id: this.userId,
                csrf: this.csrf
            }).then(response => {
                this.getReservations();
                this.showModal = false;
            }).catch(error => {
                // エラー処理
                console.log(error);
            });
        }
    },
    mounted() {
        this.getReservations();
    }
}
</script>
