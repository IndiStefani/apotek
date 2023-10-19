@extends('layouts.app')
@section('content')

<!-- Page Wrapper -->
<div class="content-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Tambah Transaksi</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Transaksi</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3" for="nm_klien">Nama Pembeli</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <input id="nm_klien" class="form-control" data-validate-length-range="6" data-validate-words="1" name="nm_klien" required="required" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-white" id="transactionTable">
                                    <thead>
                                        <tr align="center">
                                            <th style="width: 20px">#</th>
                                            <th class="col-sm">Nama Barang</th>
                                            <th class="col-sm">Qty</th>
                                            <th class="col-sm">Harga Barang</th>
                                            <th class="col-md">Total</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input type="hidden" name="kd_transaksi">
                                                <select class="form-control" style="min-width:250px" id="obat" name="details[0][nm_obat]" required>
                                                    <option value="">Pilih Obat</option>
                                                    @foreach ($obat as $key=>$obat)
                                                    <option value="{{ $obat->nm_obat }}" data-price="{{$obat->harga}}">{{$obat->nm_obat}}</option>
                                                    @endforeach
                                                    <!-- Tambahkan opsi dropdown sesuai kebutuhan -->
                                                </select>
                                            </td>
                                            <td><input class="form-control qty" style="width:250px" type="text" name="details[0][qty]" id="qty" required></td>
                                            <td><input class="form-control unit_price" style="width:250px" readonly id="harga"></td>
                                            <td><input class="form-control sub_total" style="width:150px" type="text" name="details[0][sub_total]" value="Rp. 0" readonly id="sub_total"></td>
                                        </tr>
                                    </tbody>
                                    <input type="hidden" name="details" id="details">
                                </table>
                            </div>
                            <div class="text-right m-3">
                                <button onclick="addData()" class="btn btn-info" type="button">
                                    <span class="fa fa-plus"></span> Tambah Produk
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>

                    <!-- tampilkan temporary data -->
                    <div class="table-responsive" style="display: none;" id="temporaryDataTable">
                        <table class="table table-hover table-white" id="temporaryData">
                            <thead>
                                <tr align="center">
                                    <th style="width: 20px">#</th>
                                    <th class="col-sm" style="width:20%">Nama Barang</th>
                                    <th class="col-sm" style="width:20%">Qty</th>
                                    <th class="col-sm" style="width:20%">Harga Barang</th>
                                    <th class="col-md" style="width:20%">Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="temporaryDataBody">
                                <!-- Data temporaryData akan ditampilkan di sini -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: right; font-weight: bold">
                                        Total Harga
                                    </td>
                                    <td style="font-size: 16px;width: 300px">
                                        <input class="form-control text-right" type="text" id="grand_total" name="total_harga" value="Rp 0.00" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="{{ route('transaksi.index') }}">
                                <button type="button" class="btn btn-danger">Batal</button>
                            </a>
                            <button type="button" onclick="saveData()" class="btn btn-success">Simpan</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
</div>

<!-- Script Javascript -->
<script>
    const selectObat = document.getElementById('obat');
    const inputHarga = document.getElementById('harga');

    selectObat.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        inputHarga.value = price;
    });

    // Tambahkan peristiwa input untuk qty di setiap baris
    $("#transactionTable tbody").on("input", ".qty, .nm_obat", function() {
        updateTotal();
    });

    function updateTotal() {
        var grandTotal = 0;
        $("#transactionTable tbody tr").each(function() {
            var unitPrice = parseFloat($(this).find('.unit_price').val()) || 0;
            var qty = parseFloat($(this).find('.qty').val()) || 0;
            var sub_total = unitPrice * qty;
            grandTotal += sub_total;
            $(this).find('.sub_total').val(sub_total.toFixed(2));
        });

        // Perbarui total keseluruhan
        $('#grand_total').val(grandTotal.toFixed(2));
    }


    // Inisialisasi array sementara untuk menyimpan data barang
    var temporaryData = [];

    // Fungsi untuk menambahkan data ke array sementara
    function addData() {
        var nm_obat = document.getElementById('obat').value;
        var qty = parseFloat(document.getElementById('qty').value);
        var harga = parseFloat(document.getElementById('harga').value);

        if (!nm_obat || isNaN(qty) || isNaN(harga)) {
            alert("Mohon isi semua kolom dengan benar.");
            return;
        }

        var sub_total = qty * harga;

        var data = {
            nm_obat: nm_obat,
            qty: qty,
            harga: harga,
            sub_total: sub_total
        };

        temporaryData.push(data);
        updateTemporaryDataContainer();
        clearInputFields();
    }

    // Fungsi untuk memperbarui tabel dengan data sementara
    function updateTemporaryDataContainer() {
        var tableBody = document.getElementById('temporaryDataBody');
        tableBody.innerHTML = '';
        var totalHarga = 0;

        temporaryData.forEach(function(data, index) {
            var row = tableBody.insertRow();

            // Nomor urut
            var cellNumber = row.insertCell(0);
            cellNumber.innerHTML = index + 1;

            // Nama Barang
            var cellNmObat = row.insertCell(1);
            cellNmObat.innerHTML = data.nm_obat;

            // Qty
            var cellQty = row.insertCell(2);
            cellQty.innerHTML = data.qty;

            // Harga
            var cellHarga = row.insertCell(3);
            cellHarga.innerHTML = data.harga;

            // Sub Total
            var cellSubTotal = row.insertCell(4);
            cellSubTotal.innerHTML = data.sub_total;

            totalHarga += data.sub_total;

            // Tombol Hapus
            var cellRemove = row.insertCell(5);
            cellRemove.innerHTML = '<button type="button" onclick="removeData(' + index + ')" class="btn btn-danger btn-sm">Hapus</button>';
        });

        // Memperbarui kolom input total harga
        var grandTotalInput = document.getElementById('grand_total');
        grandTotalInput.value = totalHarga.toFixed(2);

        var temporaryDataTable = document.getElementById('temporaryDataTable');
        temporaryDataTable.style.display = 'block';


        var temporaryDataTable = document.getElementById('temporaryDataTable');
        temporaryDataTable.style.display = 'block';
    }

    // Fungsi untuk menghapus data dari temporaryData
    function removeData(index) {
        temporaryData.splice(index, 1);
        updateTemporaryDataContainer();
    }


    // Fungsi untuk menghapus input setelah data ditambahkan
    function clearInputFields() {
        document.getElementById('obat').value = '';
        document.getElementById('qty').value = '';
        document.getElementById('harga').value = '';
    }


    function saveData() {
        // Generate Kode Transaksi
        var kd_transaksi = 'KR-' + new Date().getTime();

        // Mengambil data sementara
        var nm_klien = document.getElementById('nm_klien').value;
        var total_harga = document.getElementById('grand_total').value;

        // Menambahkan temporaryData menjadi array details
        var details = temporaryData.map(function(data) {
            return {
                nm_obat: data.nm_obat,
                qty: data.qty,
                sub_total: data.sub_total
            };
        });

        // Logging untuk memeriksa data sebelum dikirim
        console.log(details);

        // Kirim data ke server menggunakan Ajax
        $.ajax({
            type: 'POST',
            url: '{{ route("transaksi.store") }}',
            data: {
                kd_transaksi: kd_transaksi,
                nm_klien: nm_klien,
                total_harga: total_harga,
                details: details,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                alert('Data berhasil disimpan. Kode Transaksi: ' + kd_transaksi);
                window.location.href = '{{route("transaksi.index")}}';
            },
            error: function(error) {
                console.error('Error saving data:', error);
                alert('Gagal menyimpan data.');
            }
        });
    };
</script>





@endsection