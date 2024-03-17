<x-agent-layout>
    <div class="pt-28">
        <div class="mx-10 sm:px-16 py-10 rounded-xl">
            <x-heading-two>予約情報</x-heading-two>
            <agent-reservation-detail-component :reservation-id="{{ $reservationId }}"
                :status="{{ json_encode($status) }}"></agent-reservation-detail-component>
        </div>
    </div>
</x-agent-layout>
