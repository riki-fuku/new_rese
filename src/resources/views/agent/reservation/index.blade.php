<x-agent-layout>
    <div class="pt-28">
        <div class="mx-10 sm:px-16 py-10 rounded-xl">
            <x-heading-two>予約一覧</x-heading-two>
            <agent-reservation-list-component :reservation-list="{{ json_encode($reservationList) }}"
                :status="{{ json_encode($status) }}"></agent-reservation-list-component>
        </div>
    </div>
</x-agent-layout>
