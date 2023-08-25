<div class="card">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px;">Perbarui Kata Sandi</h5>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
            <input type="hidden" id="redirectAfterPasswordUpdate" value="{{ route('login') }}">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                        <input id="current_password" name="current_password" type="password"
                            class="form-control" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi Baru</label>
                        <input id="password" name="password" type="password" class="form-control"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4 my-4">
                <x-primary-button class="swal2-confirm btn btn-primary" id="show-sweet-alert">{{ __('Simpan') }}</x-primary-button>

                @if (session('status') === 'password-updated')
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            document.getElementById("show-sweet-alert").addEventListener("click", function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data disimpan',
                                    text: 'Perubahan Kata Sandi berhasil',
                                }).then(() => {
                                    const redirectUrl = document.getElementById("redirectAfterPasswordUpdate").value;
                                    window.location.href = redirectUrl;
                                });
                            });
                        });
                    </script>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
