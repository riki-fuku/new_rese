<x-agent-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">
            <agent-home-component :user-shop-id="{{ $userShopId }}"></agent-home-component>

            <div class="mx-auto w-3/4 item-center justify-center md:flex">
                <x-link-button :link="route('agent.reservation.index')" class="mt-10 bg-green-500">予約一覧</x-link-button>
                <x-link-button :link="route('agent.shop.qr_code')" class="mt-10 bg-green-500">店舗決済用QR表示</x-link-button>
                <x-link-button :link="route('agent.shop.edit', $userShopId)" class="mt-10 bg-green-500">店舗情報編集</x-link-button>
                <x-link-button :link="route('agent.mail.index')" class="mt-10 bg-green-500">お知らせメール作成</x-link-button>
            </div>

        </div>
    </div>
</x-agent-layout>
