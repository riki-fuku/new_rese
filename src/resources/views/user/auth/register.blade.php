<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <div class="flex items-center">
                    <i class="fas fa-user fa-2x mr-3"></i>
                    <x-input id="name" class="block mt-1 w-full rounded-none border-x-0 border-t-0 border-b-2"
                        type="text" name="name" :value="old('name')" placeholder="Username" required autofocus />
                </div>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
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
                        type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <div class="flex items-center">
                    <i class="fas fa-lock fa-2x mr-3"></i>
                    <x-input id="password" class="block mt-1 w-full rounded-none border-x-0 border-t-0 border-b-2"
                        type="password" name="password_confirmation" placeholder="Password確認用" required />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    登録
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
