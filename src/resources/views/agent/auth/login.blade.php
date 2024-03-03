<x-agent-guest-layout>
    <x-agent-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('agent.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <div class="flex items-center">
                    <i class="fas fa-envelope fa-2x mr-3"></i>
                    <x-input id="email" class="block mt-1 w-full rounded-none border-x-0 border-t-0 border-b-2"
                        type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <div class="flex items-center">
                    <i class="fas fa-lock fa-2x mr-3"></i>
                    <x-input id="password" class="block mt-1 w-full rounded-none border-x-0 border-t-0 border-b-2"
                        type="password" name="password" placeholder="Password" required
                        autocomplete="current-password" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3 bg-green-500">
                    ログイン
                </x-button>
            </div>
        </form>
    </x-agent-auth-card>
</x-agent-guest-layout>
