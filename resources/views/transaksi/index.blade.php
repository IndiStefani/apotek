@extends('layouts.app')
@section('content')

<!-- Page Wrapper -->
<div class="content-wrapper">
    <div class="row">
        <div class="grid-margin stretch-card">
            <div class="card rounded-5">
                <div class="card-body">
                    <p class="card-description mb-5">
                        <!-- Memindahkan tombol Tambah Transaksi ke kanan -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-rounded btn-md">Tambah Transaksi</a>
                    </div>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>Kode Penjualan</th>
                                    <th>Nama Klien</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $transaksi )
                                <tr>
                                    <td hidden class="ids">{{ $transaksi->id }}</td>
                                    <td><a href="{{ route('transaksi.view', ['id' => $transaksi->id]) }}">{{ $transaksi->kd_transaksi }}</a></td>
                                    <td>{{ $transaksi->nm_klien }}</td>
                                    <td>{{ $transaksi->created_at }}</td> {{-- Format tanggal sesuai dengan kebutuhan --}}
                                    <td>Rp{{ $transaksi->total_harga }}</td>
                                    <td>
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this transaksi?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->

<style>
    /* Menyesuaikan ukuran teks dalam tabel */
    .table td,
    .table th {
        font-size: 14px;
        /* Sesuaikan ukuran teks sesuai kebutuhan */
    }

    /* Menyesuaikan ukuran teks tombol */
    .btn {
        font-size: 14px;
        /* Sesuaikan ukuran teks tombol sesuai kebutuhan */
    }
</style>

<script>
    $(document).on('click', '#filter-button', function() {
        // Dapatkan tanggal yang dipilih
        var selectedDate = $('input[type="date"]').val();

        // Kirim tanggal ke server atau lakukan proses filter sesuai dengan kebutuhan Anda
        // Misalnya, Anda dapat menggunakan AJAX untuk mengambil data laporan berdasarkan tanggal.

        // Tampilkan hasil laporan sesuai dengan tanggal yang dipilih
        // Anda dapat memperbarui tabel laporan atau elemen lainnya untuk menampilkan hasilnya.
    });
</script>
@endsection