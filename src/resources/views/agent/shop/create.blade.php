<x-agent-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">
            <x-heading-two>新規店舗作成画面</x-heading-two>
            <agent-create-shop-component
                :user-id="{{ Auth::guard('agent')->user()->id }}"></agent-create-shop-component>
        </div>
    </div>
</x-agent-layout>
