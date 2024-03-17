<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="w-3/4 mx-auto max-w-80">
            <h3 class="mb-5 text-lg leading-6 font-bold text-gray-900">店舗検索画面表示</h3>
            <shop-card :shopId="shop.id" :shopName="shop.name" :areaName="areaName" :genreName="genreName"
                :topImage="topImage" />
        </div>

        <div class="w-3/4 mx-auto max-w-96">
            <h3 class="mb-5 text-lg leading-6 font-bold text-gray-900">店舗詳細画面表示</h3>
            <shop-detail :shopId="shop.id" :shopName="shop.name" :areaName="areaName" :genreName="genreName"
                :description="shop.description" :topImage="topImage" />
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import ShopCard from '../Lib/ShopCard.vue';
import ShopDetail from '../Lib/ShopDetail.vue';

export default {
    props: {
        userShopId: {
            type: Number,
            required: true
        }
    },
    components: {
        ShopCard,
        ShopDetail
    },
    data() {
        return {
            shop: [],
            areaName: '',
            genreName: '',
            topImage: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        getShop() {
            axios.get('/api/shops/show/' + this.userShopId).then(response => {
                this.topImage = '/storage/image/1/top.jpg';
                this.shop = response.data;
                this.areaName = this.shop.area.name;
                this.genreName = this.shop.genre.name;
            });
        },
    },
    mounted() {
        this.getShop();
    }
}
</script>

<style>
tr {
    height: 50px;
}
</style>
