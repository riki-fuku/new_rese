<x-app-layout>
    <div class="pt-28 px-10">
        <form action="{{ route('shop.update') }}" method="post">
            @csrf
            <table class="w-4/6 mx-auto p-4 text-left">
                <x-confirm-tr :title="'Shop'" :name="'name'" :value="$request->name" />
                <x-confirm-tr :title="'Date'" :name="'reservation_date'" :value="$request->reservation_date" />
                <x-confirm-tr :title="'Time'" :name="'reservation_time'" :value="$request->reservation_time" />
                <x-confirm-tr :title="'Number'" :name="'party_size'" :value="$request->party_size" />
            </table>

            <input type="hidden" name="id" value="{{ $request->id }}">
            <input type="hidden" name="shop_id" value="{{ $request->shop_id }}">
            <x-submit-button type="submit" class="mx-auto mt-4">予約変更</x-submit-button>
        </form>
    </div>
</x-app-layout>
