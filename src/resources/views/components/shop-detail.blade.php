<div>
    <div class="inline-block">
        <div class="w-8 h-8 bg-white rounded flex justify-center items-center">
            <a href="javascript:history.back()">
                <i class="fas fa-chevron-left fa-lg"></i>
            </a>
        </div>
    </div>
    <h2 class="ml-5 inline-block font-black text-xl">{{ $shop->name }}</h2>

    <img src={{ '/storage/image/' . $shop->id . '/top.jpg' }} alt="product" class="w-full mt-4">

    <div class="mt-4 flex text-left">
        <p># {{ $shop->area->name }}</p>
        <p class="ml-2"># {{ $shop->genre->name }}</p>
    </div>

    <div class="mt-4 flex text-left">
        <p>{{ $shop->description }}</p>
    </div>
</div>
