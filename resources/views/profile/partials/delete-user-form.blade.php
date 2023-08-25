
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="card">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px;">Hapus Akun</h5>
        <p>
            Setelah akun Anda dihapus, semua sumber daya dan data yang ada di dalamnya akan dihapus secara permanen.
            Sebelum menghapus akun Anda, harap unduh semua data atau informasi yang ingin Anda simpan.
        </p>

        <button class="btn btn-danger my-4" id="hapusAkunButton">Hapus Akun</button>

        <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <b>
                            <h5 class="modal-title" id="modalTitle">Hapus Akun</h5>
                        </b>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h4 class="text-center text-gray-900">
                                Apakah Anda yakin ingin menghapus akun Anda?
                            </h4>

                            <p class="mx-1 my-3 text-sm text-gray-600">
                                * Setelah akun Anda dihapus, semua data di dalamnya akan dihapus secara permanen.
                            </p>

                            <p class="mx-1 my-3 text-sm text-gray-600">
                                Harap masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                            </p>

                            <div class="col">
                                <label for="password" class="sr-only col-md-2">Password</label>
                                <input id="password" name="password" type="password" class="col-md-9" placeholder="Password">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="ml-3 btn btn-danger">Hapus Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const hapusAkunButton = document.getElementById('hapusAkunButton');
    const modalForm = new bootstrap.Modal(document.getElementById('modal_form'));
    
    hapusAkunButton.addEventListener('click', () => {
        modalForm.show();
    });
</script>
