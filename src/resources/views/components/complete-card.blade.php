<div class="pt-28">
    <div class="w-4/6 p-24 mx-auto bg-white border rounded-xl shadow">
        <div class="text-center">
            {{ $message }}
            <x-link-button :link="route('home')" class="mt-4">
                戻る
            </x-link-button>
        </div>
    </div>
</div>
