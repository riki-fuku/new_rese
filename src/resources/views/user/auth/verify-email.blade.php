<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            ご登録いただきありがとうございます!<br>
            始める前に、先ほどメールでお送りしたリンクをクリックして、メール アドレスを確認していただけますか?<br>
            メールが届かない場合は、喜んで別のメールをお送りいたします。
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                登録時に入力されたEメールアドレスに新しい認証リンクが送信されました。
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        確認メールを再送信
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-button type="submit">
                    ログアウト
                </x-button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
