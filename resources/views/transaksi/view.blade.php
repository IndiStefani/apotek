@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>{{$transaksi->kd_transaksi}}</strong></p>
                </div>
                <div class="col-xl-3 float-end">
                    <a id="printBtn" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                    <a id="exportBtn" class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
                </div>
                <hr>
            </div>

            <div class="container">
                <div class="col-md-12">
                    <div class="text-center">
                        <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                        <p class="pt-0">Apotek</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <ul class="list-unstyled">
                            <li class="text-muted">Nama: <span style="color:#5d9fc5 ;">{{$transaksi->nm_klien}}</span></li>
                            <li class="text-muted">alamat : <span style="color:#5d9fc5 ;">{{$transaksi->alamat}}</span></li>
                            <li class="text-muted">telp : <span style="color:#5d9fc5 ;">{{$transaksi->telp}}</span></li>
                        </ul>
                    </div>
                    <div class="col-xl-4">
                        <p class="text-muted">Invoice</p>
                        <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">transaksi_id : <span style="color:#5d9fc5 ;">#{{$transaksi->id}}</span></li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: <span style="color:#5d9fc5 ;">{{$transaksi->created_at->format('Y-m-d')}}</span></li>
                        </ul>
                    </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                        <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $detail->nm_obat }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>{{ $detail->sub_total }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="row">
                    <div class="col-xl-8">
                    </div>
                    <div class="col-xl-3">
                        <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">Rp.{{$transaksi->total_harga}}</span></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Thank you for your purchase</p>
                    </div>
                    <div class="col-xl-2">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-primary text-capitalize" style="background-color:#60bdf3 ;">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menangani klik tombol Print
    document.getElementById("printBtn").addEventListener("click", function() {
        // Pindahkan logika print yang sesuai di sini
        window.print();
    });

    // Fungsi untuk menangani klik tombol Export
    document.getElementById("exportBtn").addEventListener("click", function() {
    // Data yang akan diekspor
    var data = [];

    // Kolom header
    var header = ["#", "Nama Obat", "Qty", "Total"];
    data.push(header);

    // Isi data
    @foreach ($details as $detail)
        var row = [
            {{ $loop->index + 1 }},
            "{{ $detail->nm_obat }}",
            {{ $detail->qty }},
            "{{ $detail->sub_total }}"
        ];
        data.push(row);
    @endforeach

    // Buat worksheet
    var ws = XLSX.utils.aoa_to_sheet(data);

    // Buat workbook
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Transaksi");

    // Simpan file Excel
    XLSX.writeFile(wb, "invoice.xlsx");
});

</script>

@endsection