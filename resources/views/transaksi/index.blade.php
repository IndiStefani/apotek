@extends('layouts.app')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Transaksi</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transaksi</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto mt-5">
                <!-- Tombol untuk memicu modal -->
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <div class="row filter-row">

            <!-- Filter Tanggal -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="date" class="form-control floating">
                        <label class="focus-label">Laporan Harian/Bulanan</label>
                    </div>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn btn-success btn-block" id="filter-button"> Filter </a>
                </div>
            </div>


            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <!-- /Search Filter -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 ">
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
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Delete Estimate Modal -->
    <div class="modal custom-modal fade" id="delete_estimate" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Estimate</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="id" class="e_id" value="">
                        <input type="hidden" name="estimate_number" class="estimate_number" value="">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Estimate Modal -->

</div>
<!-- /Page Wrapper -->

@section('script')
{{-- delete model --}}
<script>
    $(document).on('click', '.delete_estimate', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.ids').text());
        $('.estimate_number').val(_this.find('.estimate_number').text());
    });

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
@endsection