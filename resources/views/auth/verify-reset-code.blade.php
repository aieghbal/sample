<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h2>تأیید کد بازنشانی رمز</h2>
        </x-slot>

        <form method="POST" action="{{ route('password.verify') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" value="ایمیل" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Code -->
            <div class="mt-4">
                <x-input-label for="verify_code" value="کد تأیید" />
                <x-text-input id="verify_code" class="block mt-1 w-full" type="text" name="verify_code" required />
                <x-input-error :messages="$errors->get('verify_code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>ادامه</x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
