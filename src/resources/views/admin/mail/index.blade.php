<x-admin-layout>
    <div class="pt-28">
        <div class="mx-10 sm:px-16 py-10 rounded-xl">
            <x-heading-two>メール送信</x-heading-two>
            <admin-mail-component :user-id="{{ Auth::id() }}"></admin-mail-component>
        </div>
    </div>
</x-admin-layout>
