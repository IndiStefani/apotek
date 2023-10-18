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
                                                <select class="form-control" style="min-width:250px" id="obat" name="nm_obat" required>
                                                    <option value="">Pilih Obat</option>
                                                    @foreach ($obat as $key=>$obat)
                                                    <option value="{{ $obat->nm_obat }}" data-price="{{$obat->harga}}">{{$obat->nm_obat}}</option>
                                                    @endforeach
                                                    <!-- Tambahkan opsi dropdown sesuai kebutuhan -->
                                                </select>
                                            </td>
                                            <td><input class="form-control qty" style="width:250px" type="text" name="qty" id="qty" required></td>
                                            <td><input class="form-control unit_price" style="width:250px" readonly id="harga"></td>
                                            <td><input class="form-control total" style="width:150px" type="text" name="sub_total" value="0" readonly id="total_1"></td>
                                            <input type="hidden" name="temporary_data" id="temporary_data">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <tbody>
                                        <tr>
                                            <td colspan="5" style="text-align: right; font-weight: bold">
                                                Total Harga
                                            </td>
                                            <td style="font-size: 16px;width: 200px">
                                                <input class="form-control text-right" type="text" id="grand_total" name="total_harga" value="Rp 0.00" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="{{ route('transaksi.index') }}">
                                <button type="button" class="btn btn-danger">Batal</button>
                            </a>
                            <button onclick="addData()" class="btn btn-info" type="button">
                                <span class="fa fa-plus"></span> Tambah Produk
                            </button>
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
            var total = unitPrice * qty;
            grandTotal += total;
            $(this).find('.total').val(total.toFixed(2));
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

        var total = qty * harga;
        var data = {
            nm_obat: nm_obat,
            qty: qty,
            harga: harga,
            total: total
        };

        temporaryData.push(data);
        updateTable();
        clearInputFields();
    }

    // Fungsi untuk memperbarui tabel dengan data sementara
    function updateTable() {
        var tableBody = document.getElementById('transactionTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        temporaryData.forEach(function(data, index) {
            var row = tableBody.insertRow(-1);
            var cellNumber = row.insertCell(0);
            var cellNamaBarang = row.insertCell(1);
            var cellQty = row.insertCell(2);
            var cellHargaBarang = row.insertCell(3);
            var cellTotal = row.insertCell(4);

            cellNumber.innerHTML = index + 1;
            cellNamaBarang.innerHTML = data.nm_obat;
            cellQty.innerHTML = data.qty;
            cellHargaBarang.innerHTML = data.harga;
            cellTotal.innerHTML = data.total;
        });
    }

    // Fungsi untuk menghapus input setelah data ditambahkan
    function clearInputFields() {
        document.getElementById('obat').value = '';
        document.getElementById('qty').value = '';
        document.getElementById('harga').value = '';
    }


    function saveData() {
        // Mengambil data sementara
        var dataToSend = JSON.stringify(temporaryData);

        // Kirim data ke server menggunakan Ajax
        $.ajax({
            type: 'POST',
            url: '{{ route('transaksi.store') }}',
            data: { temporary_data: dataToSend, _token: '{{ csrf_token() }}' },
            success: function(response) {
                // Lakukan sesuatu setelah data berhasil disimpan
                alert('Data berhasil disimpan.');
                // Redirect atau tindakan lain yang sesuai
            },
            error: function(error) {
                // Tangani kesalahan jika ada
                alert('Gagal menyimpan data.');
            }
        });
    }
</script>





@endsection