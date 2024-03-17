<template>
    <div class="mt-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        予約日
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        予約時間
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        予約者名
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        予約者メールアドレス
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        予約ステータス
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        予約詳細
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="reservation in reservationList" :key="reservation.id"
                    :class="{ 'bg-gray-300': reservation.status != 1 }">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ reservation.reservation_date }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ reservation.reservation_time }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ reservation.user.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ reservation.user.email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ this.status[reservation.status].label }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <a :href="`/agent/visit/${reservation.id}`">
                                <button
                                    class="block mx-auto rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700">
                                    詳細
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- 予約済のみ表示 -->

    </div>

</template>

<script>
import axios from 'axios';

export default {
    props: {
        reservationList: {
            type: Number,
            required: true
        },
        status: {
            type: String,
            required: true
        }
    },
    data() {
    },
    methods: {
    },
    mounted() {
    }
}
</script>

<style>
tr {
    height: 50px;
}
</style>
