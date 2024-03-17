<x-app-layout>
    <div class="pt-32">
        <div class="mx-10 px-16 py-10 bg-white rounded-xl">
            <x-heading-two>来店確認用QRコード</x-heading-two>
            <div class="mx-auto w-1/2">
                <img src="{{ $qrCodeUrl }}" alt="" class="w-full" />
            </div>
        </div>
    </div>
</x-app-layout>
