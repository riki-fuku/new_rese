<x-app-layout>
    <div class="h-28 bg-gray-100">
        <shop-search-component :areas="{{ json_encode($areas) }}" :genres="{{ json_encode($genres) }}"
            :area-id="{{ !empty($selectedArea) ? $selectedArea : 0 }}"
            :genre-id="{{ !empty($selectedGenre) ? $selectedGenre : 0 }}"
            :word="'{{ !empty($searchWord) ? $searchWord : '' }}'">
        </shop-search-component>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
        @foreach ($shops as $shop)
            <x-shop-card :shopId="$shop->id" :shopName="$shop->name" :areaName="$shop->area->name" :genreName="$shop->genre->name" :shopFavorite="$shop->favorite" />
        @endforeach
    </div>
</x-app-layout>
