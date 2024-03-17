<x-agent-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">
            <x-heading-two>店舗編集画面</x-heading-two>
            <agent-edit-shop-component :shop-id="{{ $userShopId }}"></agent-edit-shop-component>
        </div>
    </div>
</x-agent-layout>
