<template>
    <div>
        <div class="inline-block">
            <div class="w-8 h-8 bg-white rounded flex justify-center items-center">
                <i class="fas fa-chevron-left fa-lg"></i>
            </div>
        </div>
        <h2 class="ml-5 inline-block font-black text-xl">{{ shopName }}</h2>

        <img :src='topImage' alt="product" class="w-full mt-4">

        <div class="mt-4 flex text-left">
            <p># {{ areaName }}</p>
            <p class="ml-2"># {{ genreName }}</p>
        </div>

        <div class="mt-4 flex text-left">
            <p>{{ description }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        shopId: {
            type: Number,
            required: true
        },
        shopName: {
            type: String,
            required: true
        },
        areaName: {
            type: String,
            required: true
        },
        genreName: {
            type: String,
            required: true
        },
        description: {
            type: String,
            required: true
        },
        topImage: {
            type: String,
            required: true
        }
    }
}
</script>
