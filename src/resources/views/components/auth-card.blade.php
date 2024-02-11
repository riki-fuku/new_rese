<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    <div class="w-full m-5 sm:max-w-md mt-6 bg-white  shadow-md overflow-hidden sm:rounded-lg">

        <div class="bg-blue-500 w-full  p-5 text-white font-black text-lg">
            @if (Request::is('login'))
                Login
            @elseif (Request::is('register'))
                Registration
            @elseif (Request::is('verify-email'))
                認証メール送信
            @else
                Login
            @endif
        </div>

        <div class="px-6 py-4">
            {{ $slot }}
        </div>
    </div>
</div>
