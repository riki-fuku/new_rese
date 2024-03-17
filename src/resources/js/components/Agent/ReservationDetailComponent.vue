<template>
    <div class="mt-4 py-5 bg-white">
        <table class="mx-auto w-11/12 text-left">

            <!-- 予約者名 -->
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">予約者名</th>
                <td class="w-full table sm:table-cell">{{ this.reservation.user ? this.reservation.user.name : '' }}
                </td>
            </tr>

            <!-- 予約時間 -->
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">予約日時</th>
                <td class="w-full table sm:table-cell">{{ this.reservation.reservation_date }}</td>
            </tr>

            <!-- 予約人数 -->
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">予約人数</th>
                <td class="w-full table sm:table-cell">{{ this.reservation.party_size }}人</td>
            </tr>

            <!-- 予約ステータス -->
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">予約ステータス</th>
                <td class="w-full table sm:table-cell">{{ this.status[this.reservation.status] ?
                    this.status[this.reservation.status].label : '' }}</td>
            </tr>
        </table>

        <!-- 予約済のみ表示 -->
        <button v-if="this.reservation.status === '1'" @click="updateStatus()"
            class="block mx-auto rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700">
            来店済みに更新
        </button>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    props: {
        reservationId: {
            type: Number,
            required: true
        },
        status: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            reservation: {},
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        getReservation() {
            axios.get(`/api/agent/reservations/detail/${this.reservationId}`, {
                csrf: this.csrf
            }).then(response => {
                this.reservation = response.data;
                console.log(this.reservation);
            }).catch(error => {
                console.log(error);
            });
        },
        updateStatus() {
            axios.post('/api/agent/reservations/visited', {
                reservation_id: this.reservation.id,
                csrf: this.csrf
            }).then(response => {
                this.getReservation();
            }).catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
        this.getReservation();
    }
}
</script>

<style>
tr {
    height: 50px;
}
</style>
