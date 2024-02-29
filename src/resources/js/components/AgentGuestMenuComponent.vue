<template>
    <!-- ハンバーガーメニュー -->
    <div id="app" class="fixed m-5" @click="toggleMenu()">
        <div class="flex">
            <div class="w-10 h-10 bg-green-500 rounded text-white flex justify-center items-center">
                <i class="fas fa-stream fa-lg"></i>
            </div>

            <span class="mx-5 text-2xl font-bold flex items-center text-green-500">Rese(店舗代表者)</span>
        </div>
    </div>

    <!-- メニュー -->
    <div id="menu" class="fixed w-full h-full bg-white" v-show="showMenu">
        <div id="app" class="fixed m-5" @click="toggleMenu()">
            <div class="w-10 h-10 bg-green-500 rounded text-white flex justify-center items-center">
                <i class="fas fa-times fa-lg"></i>
            </div>
        </div>
        <div class="mt-48 text-center flex justify-center items-center">
            <ul class="text-green-500 text-2xl">
                <li class="my-8">
                    <a href="/admin/login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showMenu: false
        }
    },
    methods: {
        toggleMenu() {
            this.showMenu = !this.showMenu;
        }
    }
}
</script>
