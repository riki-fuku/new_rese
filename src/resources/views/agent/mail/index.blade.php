<x-agent-layout>
    <div class="pt-28">
        <div class="mx-10 sm:px-16 py-10 rounded-xl">
            <x-heading-two>メール送信</x-heading-two>
            <agent-mail-component :user-id="{{ Auth::id() }}"
                :shop-id="{{ Auth::guard('agent')->user()->shop_id }}"></agent-mail-component>
        </div>
    </div>
</x-agent-layout>
