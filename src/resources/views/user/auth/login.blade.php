<x-guest-layout>
    <x-auth-card>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
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

            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <x-button class="ml-3">
                    ログイン
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
