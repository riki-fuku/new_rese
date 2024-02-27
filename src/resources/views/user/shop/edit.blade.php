<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="mt-28 px-8">
            <x-shop-detail :shop="$reservationShop->shop" />
        </div>

        <div class="mt-10 px-8">
            <form action="{{ route('shop.update_confirm') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $reservationShop->id }}">
                <input type="hidden" name="shop_id" value="{{ $reservationShop->shop->id }}">
                <input type="hidden" name="name" value="{{ $reservationShop->shop->name }}">
                <reservation-edit-form-component :reservation-shop="{{ json_encode($reservationShop) }}" />
            </form>
        </div>
    </div>
</x-app-layout>
