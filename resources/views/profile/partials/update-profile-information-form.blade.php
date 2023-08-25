<div class="card">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px;">Informasi Profil</h5>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form id="form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="mb-3">
                            <input type="hidden" id="id" name="id" value="{{ old('id', $user->id) }}">
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" name="name" type="text" class="mt-1 block w-full form-control"
                                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="mb-3">
                            <input type="hidden" id="id" name="id">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="text" class="mt-1 block w-full form-control"
                                value="{{ old('email', $user->email) }}" required autofocus autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4 my-4">
                    <x-primary-button class="btn btn-primary" id="show-sweet-alert">{{ __('simpan') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("show-sweet-alert").addEventListener("click", function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data disimpan',
                                        text: 'perubahan profil berhasil',
                                    });
                                });
                            });
                        </script>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
