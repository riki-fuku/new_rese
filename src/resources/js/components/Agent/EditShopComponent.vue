<template>
    <div class="mt-4 py-5 bg-white">
        <div v-if="!isExistShopFlag">

            <span class="pt-5 text-red-500 text-sm" v-if="createErrorMessages">
                {{ createErrorMessages }}
            </span>

            <table class="mx-auto w-11/12 text-left">
                <tr>
                    <th class="w-full sm:w-1/3 table sm:table-cell">店名</th>
                    <td class="w-full table sm:table-cell">
                        <input type="text" name="name" class="w-full" v-model="this.name.value">
                        <span class="text-red-500 text-sm" v-if="name.error_message">
                            {{ name.error_message }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="w-full sm:w-1/3 table sm:table-cell">地域</th>
                    <td class="w-full table sm:table-cell">
                        <select name="area_id" class="w-full" v-model="this.areaId.value">
                            <option v-for="area in areaList" :value="area.id">
                                {{ area.name }}
                            </option>
                        </select>
                        <span class="text-red-500 text-sm" v-if="areaId.error_message">
                            {{ areaId.error_message }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="w-full sm:w-1/3 table sm:table-cell">ジャンル</th>
                    <td class="w-full table sm:table-cell">
                        <select name="genre_id" class="w-full" v-model="this.genreId.value">
                            <option v-for="genre in genreList" :value="genre.id">
                                {{ genre.name }}
                            </option>
                        </select>
                        <span class="text-red-500 text-sm" v-if="genreId.error_message">
                            {{ genreId.error_message }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="w-full sm:w-1/3 table sm:table-cell">店舗概要</th>
                    <td class="w-full table sm:table-cell">
                        <textarea name="description" class="w-full" v-model="this.description.value"
                            rows="10"></textarea>
                        <span class="text-red-500 text-sm" v-if="description.error_message">
                            {{ description.error_message }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="w-full sm:w-1/3 table sm:table-cell">店舗TOP画像</th>
                    <td class="w-full table sm:table-cell">
                        <input type="file" name="image" class="w-full" ref="fileInput">
                        <span class="text-red-500 text-sm" v-if="topImage.error_message">
                            {{ topImage.error_message }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="w-full sm:w-1/3 table sm:table-cell">席数</th>
                    <td class="w-full table sm:table-cell">
                        <!-- 席数は1〜100の範囲 -->
                        <input type="number" name="capacity" class="w-full" v-model="this.capacity.value" min="1"
                            max="100">
                        <span class="text-red-500 text-sm" v-if="capacity.error_message">
                            {{ capacity.error_message }}
                        </span>
                    </td>
                </tr>
            </table>

            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="resetShop()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    取り消し
                </button>
                <button @click="showPreviewModal()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    プレビュー
                </button>
            </div>
        </div>

        <div v-if="isExistShopFlag">
            <!-- ホーム画面に戻る -->
            <div class="text-center">
                <div class="py-10 text-xl font-bold text-center">
                    更新が完了しました。
                </div>
                <a href="/agent">
                    <button
                        class="mt-3 w-1/2 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        TOPに戻る
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- プレビューモーダル -->
    <div v-if="showPreviewModalFlg" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="inline-block align-bottom bg-gray-300 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- モーダルの内容 -->
                    <h3 class="text-lg leading-6 font-bold text-gray-900">店舗検索画面表示</h3>

                    <div class="w-3/4 mx-auto">
                        <shop-card :shopId="1" :shopName="name.value" :areaName="getAreaName(areaId.value)"
                            :genreName="getGenreName(genreId.value)" :topImage="topImage.value" />
                    </div>

                    <h3 class="mt-10 text-lg leading-6 font-bold text-gray-900">店舗詳細画面表示</h3>
                    <div class="w-3/4 mx-auto">
                        <shop-detail :shopId="1" :shopName="name.value" :areaName="getAreaName(areaId.value)"
                            :genreName="getGenreName(genreId.value)" :description="description.value"
                            :topImage="topImage.value" />
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showPreviewModalFlg = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        閉じる
                    </button>
                    <button @click="createShop()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        店舗更新
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- プレビューモーダルここまで -->

</template>

<script>
import axios from 'axios';
import ShopCard from '../Lib/ShopCard.vue';
import ShopDetail from '../Lib/ShopDetail.vue';

export default {
    props: {
        shopId: {
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
            areaList: [],
            genreList: [],
            name: {
                value: '',
                error_message: ''
            },
            areaId: {
                value: '',
                error_message: ''
            },
            genreId: {
                value: '',
                error_message: ''
            },
            description: {
                value: '',
                error_message: ''
            },
            topImage: {
                value: '',
                error_message: ''
            },
            capacity: {
                value: '1',
                error_message: ''
            },
            showPreviewModalFlg: false,
            isExistShopFlag: false,
            createErrorMessages: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        getShopDetail() {
            axios.get('/api/shops/show/' + this.shopId).then(response => {
                this.name.value = response.data.name;
                this.areaId.value = response.data.area_id;
                this.genreId.value = response.data.genre_id;
                this.description.value = response.data.description;
                this.capacity.value = response.data.capacity;
            });
        },
        getAreaList() {
            axios.get('/api/areas').then(response => {
                this.areaList = response.data;
            });
        },
        getAreaName(areaId) {
            return this.areaList.find(area => area.id === areaId).name;
        },
        getGenreList() {
            axios.get('/api/genres').then(response => {
                this.genreList = response.data;
            });
        },
        getGenreName(genreId) {
            return this.genreList.find(genre => genre.id === genreId).name;
        },
        resetShop() {
            this.name = {
                value: '',
                error_message: ''
            };
            this.areaId = {
                value: '',
                error_message: ''
            };
            this.genreId = {
                value: '',
                error_message: ''
            };
            this.description = {
                value: '',
                error_message: ''
            };
            this.topImage = {
                value: '',
                error_message: ''
            };
            this.capacity = {
                value: '1',
                error_message: ''
            };
        },
        showPreviewModal() {
            // 入力チェック
            if (this.validateShop()) {
                // 画像の読み込み
                this.loadImage();

                // モーダル表示
                this.showPreviewModalFlg = true;
            }
        },
        validateShop() {
            // 店名チェック
            if (this.name.value === '') {
                this.name.error_message = '店名を入力してください';
                return false;
            } else if (this.name.value.length > 20) {
                this.name.error_message = '店名は10文字以内で入力してください';
                return false;
            } else {
                this.name.error_message = '';
            }

            // 地域チェック
            if (this.areaId.value === '') {
                this.areaId.error_message = '地域を選択してください';
                return false;
            } else {
                this.areaId.error_message = '';
            }

            // ジャンルチェック
            if (this.genreId.value === '') {
                this.genreId.error_message = 'ジャンルを選択してください';
                return false;
            } else {
                this.genreId.error_message = '';
            }

            // 店舗概要チェック
            if (this.description.value === '') {
                this.description.error_message = '店舗概要を入力してください';
                return false;
            } else if (this.description.value.length > 200) {
                this.description.error_message = '店舗概要は200文字以内で入力してください';
                return false;
            } else {
                this.description.error_message = '';
            }

            // 店舗TOP画像のチェック
            if (!this.validateFile()) {
                return false;
            }

            // 席数チェック
            if (this.capacity.value === '') {
                this.capacity.error_message = '席数を入力してください';
                return false;
            } else if (this.capacity.value < 1 || this.capacity.value > 100) {
                this.capacity.error_message = '席数は1〜100の範囲で入力してください';
                return false;
            } else {
                this.capacity.error_message = '';
            }

            return true;
        },
        validateFile() {
            const file = this.$refs.fileInput.files[0];
            const maxSize = 1024 * 1024 * 5; // 5MBまでのみ許可
            const validTypes = ['image/jpeg']; // jpegのみ許可

            if (!file) {
                this.topImage.error_message = '画像ファイルを選択してください';
                return false;
            } else if (file.size > maxSize) {
                this.topImage.error_message = 'ファイルサイズが大きすぎます。5MB以下のファイルを選択してください。';
                return false;
            } else if (!validTypes.includes(file.type)) {
                this.topImage.error_message = '無効なファイルタイプです。JPEGファイルのみアップロードできます。';
                return false;
            } else {
                this.topImage.value = file;
                this.topImage.error_message = '';
            }

            return true;
        },
        createShop() {
            // バリデーションチェック
            if (this.validateShop()) {

                axios.post('/api/shops/update', {
                    id: this.shopId,
                    name: this.name.value,
                    area_id: this.areaId.value,
                    genre_id: this.genreId.value,
                    description: this.description.value,
                    capacity: this.capacity.value
                }, {
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    this.showPreviewModalFlg = false;
                    this.resetShop();
                    this.isExistShopFlag = true;
                }).catch(error => {
                    this.showPreviewModalFlg = false;
                    this.createErrorMessages = '店舗の更新に失敗しました。';
                });

                // TODO:ファイルアップロード未実装
                // // バリデーションOKの場合、登録処理を実行
                // const formData = new FormData();
                // formData.append('user_id', this.userId);
                // formData.append('name', this.name.value);
                // formData.append('area_id', this.areaId.value);
                // formData.append('genre_id', this.genreId.value);
                // formData.append('description', this.description.value);
                // formData.append('capacity', this.capacity.value);

                // // 画像ファイルを追加
                // const fileInput = this.$refs.fileInput;
                // if (fileInput && fileInput.files[0]) {
                //     formData.append('image', fileInput.files[0]);
                // }

                // axios.post('/api/shops', {
                //     headers: {
                //         'X-CSRF-TOKEN': this.csrf,
                //         'Content-Type': 'multipart/form-data'
                //     }
                // }).then(response => {
                //     this.showPreviewModalFlg = false;
                //     this.resetShop();
                // }).catch(error => {
                //     console.log(error.response.data.message);
                //     this.createErrorMessages = '店舗の新規登録に失敗しました。';
                // });
            }
        },
        loadImage() {
            const file = this.$refs.fileInput.files[0];
            const reader = new FileReader();

            reader.onload = (e) => {
                this.topImage.value = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    },
    mounted() {
        this.getShopDetail();
        this.getAreaList();
        this.getGenreList();
    }
}
</script>

<style>
tr {
    height: 50px;
}
</style>
