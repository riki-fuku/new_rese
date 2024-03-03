<x-admin-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">
            <x-link-button :link="route('admin.management_agent.index')" class="bg-yellow-500">店舗代表者作成</x-link-button>
            <x-link-button :link="route('admin.mail.index')" class="mt-10 bg-yellow-500">お知らせメール作成</x-link-button>
        </div>
    </div>
</x-admin-layout>
