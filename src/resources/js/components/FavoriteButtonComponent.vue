<template>
    <div class="mt-2 flex justify-end" :class="{ 'text-gray-200': !favoriteFlg, 'text-red-500': favoriteFlg }" @click="toggleFavorite(shopId)">
        <i class="fa fa-heart fa-lg"></i>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        shopId: Number,
        userId: Number,
        favorite: Boolean
    },
    data() {
        return {
            favoriteFlg: this.favorite,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        toggleFavorite(shopId) {
            axios.post('/api/favorite', {
                shopId: shopId,
                userId: this.userId,
                favoriteFlg: this.favoriteFlg,
                csrf: this.csrf
            })
            .then(response => {
                // 成功した場合はお気に入りフラグを反転
                this.favoriteFlg = !this.favoriteFlg;
                console.log(response.data);
            })
            .catch(error => {
                // エラー処理
                console.log(error);
            });
        }
    }
}
</script>
