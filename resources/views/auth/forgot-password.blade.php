{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan Anda tautan pengaturan ulang kata sandi melalui email.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button>
                <a href="{{ route('login') }}" class="btn-danger mr-3">
                    {{ __('Kembali') }}
                </a>
            </button>
            
            <x-primary-button>
                {{ __('kirim') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan Anda tautan pengaturan ulang kata sandi melalui email.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="login_by" :value="__('Email')" />
            <x-text-input id="login_by" class="block mt-1 w-full" type="email" name="login_by" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('login_by')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button>
                <a href="{{ route('login') }}" class="btn-danger mr-3">
                    {{ __('Kembali') }}
                </a>
            </button>
            
            <x-primary-button>
                {{ __('kirim') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan Anda tautan pengaturan ulang kata sandi melalui email.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" onsubmit="return validateForm()">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="login_by" :value="__('Email')" />
            <x-text-input id="login_by" class="block mt-1 w-full" type="email" name="login_by" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('login_by')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button>
                <a href="{{ route('login') }}" class="btn-danger mr-3">
                    {{ __('Kembali') }}
                </a>
            </button>
            
            <x-primary-button type="submit">
                {{ __('Kirim') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
