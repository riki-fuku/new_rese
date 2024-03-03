<template>
    <div class="py-10 px-6 bg-blue-500 rounded-t-lg">

        <div class="text-white font-black text-lg">
            予約変更
        </div>

        <div class="mt-4">
            <!-- 予約日付 -->
            <input type="date" name="reservation_date" id="reservation_date" class="w-1/2 py-2 rounded-lg" v-model="reservationDate">

            <!-- 予約時間 -->
            <select name="reservation_time" id="reservation_time" class="w-full mt-3 py-2 rounded-lg" v-model="reservationTime">
                <option v-for="time in createTimeSlots()" :value="time">{{ time }}</option>
            </select>

            <!-- 予約人数 -->
            <select name="party_size" id="party_size" class="w-full mt-3 py-2 rounded-lg" v-model="partySize">
                <option v-for="number in createPartySize()" :value="number">{{ number }}人</option>
            </select>
        </div>

        <div class="mt-4 py-5 px-4 bg-blue-400 rounded-lg">
            <table class="w-full text-white text-left">
                <tr>
                    <th class="w-1/4">Shop</th>
                    <td>{{ reservationShop.shop.name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ reservationDate }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ reservationTime }}</td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td>{{ partySize }}人</td>
                </tr>
            </table>
        </div>

    </div>
    <div class="bg-blue-700 rounded-b-lg hover:bg-blue-900 active:bg-gray-700">
        <input type="submit" value="変更する" class="w-full py-3 text-white text-center">
    </div>
</template>

<script>
export default {
    props: {
        reservationShop: Object,
    },
    data() {
        return {
            reservationDate: this.reservationShop.reservation_date,
            reservationTime: this.reservationShop.reservation_time.slice(0, 5),
            partySize: this.reservationShop.party_size
        }
    },
    methods: {
        createTimeSlots() {
            let timeList = [];
            let start = 16 * 60; // 16:00 in minutes
            let end = 20 * 60; // 20:00 in minutes

            for (let i = start; i <= end; i += 15) {
                let hours = Math.floor(i / 60);
                let minutes = i % 60;

                if (hours < 10) hours = '0' + hours;
                if (minutes < 10) minutes = '0' + minutes;

                timeList.push(`${hours}:${minutes}`);
            }

            return timeList;
        },
        createPartySize() {
            let partySizeList = [];
            for (let i = 1; i <= 4; i++) {
                partySizeList.push(i);
            }

            return partySizeList;
        }
    },
}
</script>
