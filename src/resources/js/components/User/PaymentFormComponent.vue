<template>
    <div class="py-10 px-6 rounded-t-lg">

        <div class="font-black text-2xl">
            決済（{{ this.reservation.shop.name }}）
        </div>

        <div class="mt-4">
            <!-- 支払金額 -->
            <label class="block" for="amount">支払金額</label>
            <input type="text" name="amount" id="amount" class="w-full py-2 rounded-lg">

            <!-- カード番号 -->
            <label class="block mt-5" for="card_number">カード番号</label>
            <input type="text" name="card_number" id="card_number" class="w-full py-2 rounded-lg"
                placeholder="1234 1234 1234 1234">

            <!-- 有効期限 -->
            <label class="block mt-5" for="card_expiry">有効期限</label>
            <input type="text" name="card_expiry" id="card_expiry" class="w-1/2 py-2 rounded-lg" placeholder="月 / 年">

            <!-- セキュリティコード -->
            <label class="block mt-5" for="security_code">セキュリティコード</label>
            <input type="text" name="security_code" id="security_code" class="w-1/2 py-2 rounded-lg" placeholder="CVC">
        </div>
    </div>
    <div class="w-36 m-auto bg-blue-700 rounded-lg hover:bg-blue-900 active:bg-gray-700">
        <input type="button" value="支払い" class="w-full py-3 text-white text-center">
    </div>
</template>

<script>
export default {
    props: {
        reservation: Object,
    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {
        console.log(this.reservation);
    }
}
</script>
