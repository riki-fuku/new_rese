<x-agent-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">
            <div class="text-center">
                店舗情報がありません。新規作成してください。
            </div>
            <x-link-button :link="route('admin.management_agent.index')" class="mt-10 bg-green-500">店舗新規作成</x-link-button>
            <x-link-button :link="route('admin.mail.index')" class="mt-10 bg-green-500">お知らせメール作成</x-link-button>
        </div>
    </div>
</x-agent-layout>
