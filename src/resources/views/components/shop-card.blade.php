<div class="mx-3 mb-4 bg-white border rounded-xl shadow">
    <img src={{ '/storage/image/' . $shopId . '/top.jpg' }} alt="product" class="w-full rounded-t-xl">
    <div class="my-5 mx-5">
        <h3 class="text-left font-bold text-xl">{{ $shopName }}</h3>
        <div class="mt-2 flex text-left">
            <p># {{ $areaName }}</p>
            <p class="ml-2"># {{ $genreName }}</p>
        </div>
        <div class="mt-2 flex justify-between">
            <a href="{{ route('shop.detail', ['id' => $shopId]) }}">
                <button
                    class="'inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">
                    詳しく見る
                </button>
            </a>

            <favorite-button-component :shop-id="{{ $shopId }}" :user-id="{{ Auth::id() }}"
                :favorite='{{ $shopFavorite ? 'true' : 'false' }}'></favorite-button-component>
        </div>
    </div>
</div>
