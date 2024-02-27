<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="mt-28 px-8">
            <x-shop-detail :shop="$shop" />
        </div>

        <div class="mt-10 px-8">
            <form action="{{ route('shop.confirm') }}" method="post">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input type="hidden" name="name" value="{{ $shop->name }}">
                <reservation-form-component :shop="{{ json_encode($shop) }}" />
            </form>
        </div>
    </div>
</x-app-layout>
