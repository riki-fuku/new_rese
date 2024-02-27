<x-app-layout>
    <div class="pt-28 grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="px-8">
            <div class="h-16">
                <div class="block md:hidden text-3xl font-bold">
                    {{ auth()->user()->name }}
                </div>
            </div>
            <x-heading-two>予約状況</x-heading-two>

            <reservation-list-component :status="{{ json_encode($status) }}"></reservation-list-component>
        </div>

        <div class="px-8">
            <div class="h-16">
                <div class="hidden md:block text-3xl font-bold">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <x-heading-two>お気に入り店舗</x-heading-two>

            <div class="grid lg:grid-cols-2 gap-2">
                @foreach ($favoriteShops as $favoriteShop)
                    <x-shop-card :shopId="$favoriteShop->shop->id" :shopName="$favoriteShop->shop->name" :areaName="$favoriteShop->shop->area->name" :genreName="$favoriteShop->shop->genre->name"
                        :shopFavorite="true" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
