<template>

    <button
        class="'inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'"
        @click="showInsertModal()">
        新規登録
    </button>

    <div class="mt-4">
        <table class="w-full border text-center bg-white">
            <tr class="bg-yellow-100">
                <th class="border">店舗名</th>
                <th class="border">ユーザー名</th>
                <th class="border">メールアドレス</th>
                <th class="border">有効フラグ</th>
                <th class="border">アクション</th>
            </tr>
            <tr v-for="shopUser in shopUserList" :class="shopUser.invalid_flag == 0 ? 'bg-gray-500' : 'bg-white'">
                <td class="border">
                    <div v-if="shopUser.shop">
                        {{ shopUser.shop.name }}
                    </div>
                </td>
                <td class="border">{{ shopUser.name }}</td>
                <td class="border">{{ shopUser.email }}</td>
                <td class="border">
                    {{ shopUser.invalid_flag == 0 ? '無効' : '有効' }}
                </td>
                <td class="border">
                    <button
                        class="'inline-flex items-center my-1 mx-3 px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'"
                        @click="showUpdateModal(shopUser.id)">
                        編集
                    </button>
                    <button
                        class="'inline-flex items-center my-1 mx-3 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'"
                        :class="shopUser.invalid_flag == 0 ? 'bg-green-500' : 'bg-red-500'"
                        @click="changeInvalidShopUser(shopUser.id, shopUser.name, shopUser.invalid_flag)">
                        {{ shopUser.invalid_flag == 0 ? '有効化' : '無効化' }}
                    </button>
                </td>
            </tr>
        </table>
    </div>

    <!-- 新規登録モーダル -->
    <div v-if="showInsertModalFlg" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="inline-block align-bottom bg-gray-300 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- モーダルの内容 -->
                    <h3 class="font-bold text-lg leading-6 text-gray-900">
                        新規登録
                    </h3>

                    <p class="text-red-500 text-sm" v-if="errorMessage">
                        {{ errorMessage }}
                    </p>

                    <table class="w-10/12 mx-auto">
                        <tr>
                            <td class="w-36">店舗名</td>
                            <td>
                                <select name="shop_id" v-model="this.shopId.value" class="w-full">
                                    <option v-for="shop in shopList" :value="shop.id">{{ shop.name }}</option>
                                </select>
                                <span class="text-red-500 text-sm" v-if="shopId.error_message">
                                    {{ shopId.error_message }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>ユーザー名</td>
                            <td>
                                <input type="text" name="name" v-model="this.name.value" class="w-full" />
                                <span class="text-red-500 text-sm" v-if="name.error_message">
                                    {{ name.error_message }}
                                </span>
                            </td>
                        </tr>
                        <tr class="mt-3">
                            <td>メールアドレス</td>
                            <td>
                                <input type="email" name="email" v-model="email.value" class="w-full" />
                                <span class="text-red-500 text-sm" v-if="email.error_message">
                                    {{ email.error_message }}
                                </span>
                            </td>
                        </tr>
                        <tr class="mt-3">
                            <td>パスワード</td>
                            <td>
                                <input type="password" name="password" v-model="password.value" class="w-full" />
                                <span class="text-red-500 text-sm" v-if="password.error_message">
                                    {{ password.error_message }}
                                </span>
                            </td>
                        </tr>
                    </table>
                    ※登録したい店舗がある場合のみ、店舗名を選択してください
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showInsertModalFlg = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        閉じる
                    </button>
                    <button @click="submitInsertAgent()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        登録
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- 新規登録モーダルここまで -->

    <!-- 編集モーダル -->
    <div v-if="showUpdateModalFlg" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="inline-block align-bottom bg-gray-300 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- モーダルの内容 -->
                    <h3 class="font-bold text-lg leading-6 text-gray-900">
                        編集
                    </h3>

                    <p class="text-red-500 text-sm" v-if="errorMessage">
                        {{ errorMessage }}
                    </p>

                    <table class="w-10/12 mx-auto">
                        <tr>
                            <td class="w-36">店舗名</td>
                            <td>
                                <select name="shop_id" v-model="this.shopId.value" class="w-full">
                                    <option v-for="shop in shopList" :value="shop.id">{{ shop.name }}</option>
                                </select>
                                <span class="text-red-500 text-sm" v-if="shopId.error_message">
                                    {{ shopId.error_message }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>ユーザー名</td>
                            <td>
                                <input type="text" name="name" v-model="this.name.value" class="w-full" />
                                <span class="text-red-500 text-sm" v-if="name.error_message">
                                    {{ this.name.error_message }}
                                </span>
                            </td>
                        </tr>
                        <tr class="mt-3">
                            <td>メールアドレス</td>
                            <td>
                                <input type="email" name="email" v-model="email.value" class="w-full" />
                                <span class="text-red-500 text-sm" v-if="email.error_message">
                                    {{ email.error_message }}
                                </span>
                            </td>
                        </tr>
                        <tr class="mt-3">
                            <td>新規パスワード</td>
                            <td>
                                <input type="password" name="password" v-model="password.value" class="w-full" />
                                <span class="text-red-500 text-sm" v-if="password.error_message">
                                    {{ password.error_message }}
                                </span>
                            </td>
                        </tr>
                    </table>
                    ※パスワードを変更しない場合は入力不要です
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showUpdateModalFlg = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        閉じる
                    </button>
                    <button @click="submitUpdateAgent()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        更新
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- 編集モーダルここまで -->

</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            shopUserList: [],
            shopUserDetail: {},
            shopList: [],
            showInsertModalFlg: false,
            showUpdateModalFlg: false,
            confirmMessage: '',
            errorMessage: '',
            validateResult: false,
            shopId: {
                value: '',
                error_message: ''
            },
            name: {
                value: '',
                error_message: ''
            },
            email: {
                value: '',
                error_message: ''
            },
            password: {
                value: '',
                error_message: ''
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        getShopUserList() {
            axios.get('/api/shop_users').then(response => {
                this.shopUserList = response.data;
            });
        },
        getShopUser(id) {
            axios.get('/api/shop_users/show/' + id).then(response => {
                this.shopUserDetail = response.data;

                // 値をセット
                this.shopId.value = this.shopUserDetail.shop_id;
                this.name.value = this.shopUserDetail.name;
                this.email.value = this.shopUserDetail.email;
            });
        },
        getShopList() {
            axios.get('/api/shops')
                .then(response => {
                    this.shopList = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showInsertModal() {
            // モーダル初期化
            this.modalReset();
            // モーダル表示
            this.showInsertModalFlg = true;
        },
        showUpdateModal(id) {
            // モーダル初期化
            this.modalReset();

            // ユーザー情報取得
            this.getShopUser(id);

            // モーダル表示
            this.showUpdateModalFlg = true;
        },
        changeInvalidShopUser(id, userName, invalidFlag) {
            if (invalidFlag == 1) {
                this.confirmMessage = `${userName}のログインを無効にしますか？`;
            } else if (invalidFlag == 0) {
                this.confirmMessage = `${userName}のログインを有効にしますか？`;
            }

            if (confirm(this.confirmMessage)) {
                axios.post('/api/shop_users/change_invalid', {
                    id: id,
                    csrf: this.csrf
                }).then(response => {
                    this.getShopUserList();
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        submitInsertAgent() {
            // バリデーションチェック
            if (this.validateInsertForm()) {

                if (this.shopId.value === '') {
                    this.shopId.value = null;
                }

                // バリデーションOKの場合、登録処理を実行
                axios.post('/api/shop_users/store', {
                    shop_id: this.shopId.value,
                    name: this.name.value,
                    email: this.email.value,
                    password: this.password.value,
                    csrf: this.csrf
                })
                    .then(response => {
                        this.showInsertModalFlg = false;
                        this.$emit('inserted');
                        this.getShopUserList();
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message || 'エラーが発生しました';
                        console.log(error);
                    });
            }
        },
        submitUpdateAgent() {
            // バリデーションチェック
            if (this.validateUpdateForm()) {
                // バリデーションOKの場合、登録処理を実行
                axios.post('/api/shop_users/update', {
                    id: this.shopUserDetail.id,
                    shop_id: this.shopId.value,
                    name: this.name.value,
                    email: this.email.value,
                    password: this.password.value,
                    csrf: this.csrf
                })
                    .then(response => {
                        this.showUpdateModalFlg = false;
                        this.$emit('inserted');
                        this.getShopUserList();
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message || 'エラーが発生しました';
                        console.log(error);
                    });
            }
        },
        modalReset() {
            this.errorMessage = '';
            this.validateResult = false;
            this.shopId.value = '';
            this.shopId.error_message = '';
            this.name.value = '';
            this.name.error_message = '';
            this.email.value = '';
            this.email.error_message = '';
            this.password.value = '';
            this.password.error_message = '';
        },
        validateInsertForm() {
            // 名前チェック
            if (this.name.value === '') {
                this.name.error_message = '名前を入力してください';
                return false;
            } else if (this.name.value.length > 20) {
                this.name.error_message = '名前は20文字以内で入力してください';
                return false;
            } else {
                this.name.error_message = '';
            }

            // メールアドレスチェック
            if (this.email.value === '') {
                this.email.error_message = 'メールアドレスを入力してください';
                return false;
            } else if (!this.email.value.match(/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i)) {
                this.email.error_message = 'メールアドレスの形式が正しくありません';
                return false;
            } else if (this.email.value.length > 255) {
                this.email.error_message = 'メールアドレスは255文字以内で入力してください';
                return false;
            } else {
                this.email.error_message = '';
            }

            // パスワードチェック
            if (this.password.value === '') {
                this.password.error_message = 'パスワードを入力してください';
                return false;
            } else if (this.password.value.length < 8) {
                this.password.error_message = 'パスワードは8文字以上で入力してください';
                return false;
            } else {
                this.password.error_message = '';
            }

            return true;
        },
        validateUpdateForm() {
            // 名前チェック
            if (this.name.value === '') {
                this.name.error_message = '名前を入力してください';
                return false;
            } else if (this.name.value.length > 20) {
                this.name.error_message = '名前は20文字以内で入力してください';
                return false;
            } else {
                this.name.error_message = '';
            }

            // メールアドレスチェック
            if (this.email.value === '') {
                this.email.error_message = 'メールアドレスを入力してください';
                return false;
            } else if (!this.email.value.match(/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i)) {
                this.email.error_message = 'メールアドレスの形式が正しくありません';
                return false;
            } else if (this.email.value.length > 255) {
                this.email.error_message = 'メールアドレスは255文字以内で入力してください';
                return false;
            } else {
                this.email.error_message = '';
            }

            // パスワードチェック
            if (this.password.value !== '') {
                if (this.password.value.length < 8) {
                    this.password.error_message = 'パスワードは8文字以上で入力してください';
                    return false;
                } else {
                    this.password.error_message = '';
                }
            }

            return true;
        },
    },
    mounted() {
        this.getShopUserList();
        this.getShopList()
    }
}
</script>

<style>
tr {
    height: 50px;
}
</style>
