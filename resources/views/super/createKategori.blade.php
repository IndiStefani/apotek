<!-- Modal untuk menambahkan kategori baru -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi formulir kategori di sini -->
                <form action="{{ route('super.kategoriStore') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nm_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nm_kategori" name="nm_kategori" required>
                    </div>

                    <!-- Tambahkan lebih banyak bidang jika diperlukan -->

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>