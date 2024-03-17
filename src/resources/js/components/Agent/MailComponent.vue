<template>
    <div class="mt-4 py-5 bg-white">
        <table class="mx-auto w-11/12 text-left">
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">テンプレート</th>
                <td class="w-full table sm:table-cell">
                    <select class="w-full" v-model="this.emailTemplateId"
                        @change="writeMailTemplate(this.emailTemplateId)">
                        <option v-for="emailTemplate in emailTemplateList" :value="emailTemplate.id">
                            {{ emailTemplate.name }}
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">タイトル</th>
                <td class="w-full table sm:table-cell">
                    <input type="text" name="subject" class="w-full" v-model="this.emailSubject.value">
                    <span class="text-red-500 text-sm" v-if="emailSubject.error_message">
                        {{ emailSubject.error_message }}
                    </span>
                </td>
            </tr>
            <tr>
                <th class="w-full sm:w-1/3 table sm:table-cell">本文</th>
                <td class="w-full table sm:table-cell">
                    <textarea name="body" class="w-full" v-model="this.emailBody.value" rows="10"></textarea>
                    <span class="text-red-500 text-sm" v-if="emailBody.error_message">
                        {{ emailBody.error_message }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="pl-5">
            ※テンプレートを選ぶことで、タイトルと本文が自動で入力されます。
        </div>

        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="resetEmailTemplate()"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                取り消し
            </button>
            <button @click="showPreviewModal()"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                プレビュー
            </button>
        </div>
    </div>

    <!-- プレビューモーダル -->
    <div v-if="showPreviewModalFlg" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="inline-block align-bottom bg-gray-300 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- モーダルの内容 -->
                    <table class="w-10/12 mx-auto">
                        <tr>
                            <td class="w-36 border text-center">タイトル</td>
                            <td class="p-2 border">{{ this.emailSubject.value }}</td>
                        </tr>
                        <tr>
                            <td class="border text-center">本文</td>
                            <td class="p-2 border" v-html="this.emailBody.value"></td>
                        </tr>
                    </table>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showPreviewModalFlg = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        閉じる
                    </button>
                    <button @click="sendMail()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        送信
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- プレビューモーダルここまで -->

</template>

<script>
import axios from 'axios';

export default {
    props: {
        // メール送信先のユーザーID
        userId: {
            type: Number,
            required: true
        },
        shopId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            userType: '2', // 2:店舗代表者
            emailTemplateList: [],
            emailTemplateId: '',
            emailSubject: {
                value: '',
                error_message: ''
            },
            emailBody: {
                value: '',
                error_message: ''
            },
            showPreviewModalFlg: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        getEmailTemplateList() {
            axios.get('/api/email_templates/' + this.userType).then(response => {
                this.emailTemplateList = response.data;
            });
        },
        writeMailTemplate() {
            for (let i = 0; i < this.emailTemplateList.length; i++) {
                if (this.emailTemplateList[i].id == this.emailTemplateId) {
                    this.emailSubject.value = this.emailTemplateList[i].subject;
                    this.emailBody.value = this.emailTemplateList[i].body;
                }
            }
        },
        resetEmailTemplate() {
            this.emailTemplateId = '';
            this.emailSubject = {
                value: '',
                error_message: ''
            };
            this.emailBody = {
                value: '',
                error_message: ''
            };
        },
        showPreviewModal() {
            // 入力チェック
            if (this.validateEmail()) {
                // モーダル表示
                this.showPreviewModalFlg = true;
            }
        },
        validateEmail() {
            // タイトルチェック
            if (this.emailSubject.value === '') {
                this.emailSubject.error_message = 'タイトルを入力してください';
                return false;
            } else if (this.emailSubject.value.length > 50) {
                this.emailSubject.error_message = 'タイトルは50文字以内で入力してください';
                return false;
            } else {
                this.emailSubject.error_message = '';
            }

            // 本文チェック
            if (this.emailBody.value === '') {
                this.emailBody.error_message = '本文を入力してください';
                return false;
            } else {
                this.emailBody.error_message = '';
            }

            return true;
        },
        sendMail() {
            // バリデーションチェック
            if (this.validateEmail()) {
                // バリデーションOKの場合、登録処理を実行
                axios.post('/api/agent/send_email', {
                    user_id: this.userId,
                    shop_id: this.shopId,
                    email_template_id: this.emailTemplateId,
                    subject: this.emailSubject.value,
                    body: this.emailBody.value
                }, {
                    headers: {
                        'X-CSRF-TOKEN': this.csrf
                    }
                }).then(response => {
                    console.log(response.data);
                    this.resetEmailTemplate();
                    this.showPreviewModalFlg = false;
                });
            }
        },
    },
    mounted() {
        this.getEmailTemplateList();
    }
}
</script>

<style>
tr {
    height: 50px;
}
</style>
