<template>
    <!-- ハンバーガーメニュー -->
    <div class="fixed m-10">
        <div class="flex">
            <div class="w-10 h-10 bg-blue-500 rounded text-white flex justify-center items-center" @click="toggleMenu()">
                <i class="fas fa-stream fa-lg"></i>
            </div>

            <Transition name="slide-fade">
                <span v-if="isTop" class="mx-5 text-2xl font-bold flex items-center text-blue-600">Rese</span>
            </Transition>

        </div>
    </div>

    <!-- メニュー -->
    <div id="menu" class="fixed w-full h-full bg-white z-10" v-show="showMenu">
        <div id="app" class="fixed m-10" @click="toggleMenu()">
            <div class="w-10 h-10 bg-blue-500 rounded text-white flex justify-center items-center">
                <i class="fas fa-times fa-lg"></i>
            </div>
        </div>
        <div class="mt-48 text-center flex justify-center items-center">
            <ul class="text-blue-600 text-2xl">
                <li class="my-8">
                    <a href="/home">Home</a>
                </li>
                <li class="my-8">
                    <form method="POST" action="/logout">
                        <input type="hidden" name="_token" :value="csrf">
                        <a href="#" @click.prevent="logout" class="nav-link">
                            Logout
                        </a>
                    </form>
                </li>
                <li class="my-8">
                    <a href="/mypage">Mypage</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showMenu: false,
                isTop: true, //画面が一番上にあるかどうかを示すフラグ
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            toggleMenu() {
                this.showMenu = !this.showMenu;
            },
            logout(event) {
                event.target.closest('form').submit();
            },
            checkScroll() { //スクロール位置をチェックするメソッド
                this.isTop = window.scrollY === 0;
            }
        },
        mounted() { // コンポーネントがマウントされたときにイベントリスナーを設定
            window.addEventListener('scroll', this.checkScroll);
        },
        beforeDestroy() { // コンポーネントが破棄される前にイベントリスナーを削除
            window.removeEventListener('scroll', this.checkScroll);
        }
    }
</script>

<style>
    .slide-fade-enter-active {
        transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
        transform: translateX(20px);
        opacity: 0;
    }
</style>
