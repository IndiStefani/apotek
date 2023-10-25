<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apotek') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap JavaScript (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Apotek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex float-right">
                    <div id="cart">
                        <button class="btn btn-outline-dark bi-cart-fill" type="button" onclick="showInvoice()">
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </div>

                    <!-- menampilkan modal -->
                    <div id="invoiceModal" class="modal" style="display: none;">
                        <div class="modal-content" style="height: 100%; width: 100%; background-color: white;">
                            <div class="row mt-5">
                                <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                    <div class="row">
                                        <div class="text-center">
                                            <h1>Checkout</h1>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-white">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Barang</th>
                                                        <th>Qty</th>
                                                        <th>Harga Barang</th>
                                                        <th>Sub Total</th>
                                                        <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="temporaryData">
                                                    <!-- Data temporaryData akan ditampilkan di sini -->
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" style="text-align: right; font-weight: bold">
                                                            Total Harga
                                                        </td>
                                                        <td>
                                                            <input class="form-control text-right" type="text" id="invoiceGrandTotal" value="Rp 0.00" readonly>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <button type="button" class="btn btn-success btn-lg btn-block">
                                                Submit<span class="glyphicon"></span>
                                            </button></td>
                                            <button type="button" class="btn btn-danger btn-lg btn-block" onclick="closeInvoice()">
                                                Tutup
                                            </button></td>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <!-- <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header> -->

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <!-- card produk -->
                @foreach($obat as $key=>$obat)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                            <img class="card-img-top" src="{{ asset('image/' . $obat->poster) }}" alt="{{ $obat->nm_obat }}" style="max-width: 150px; max-height: 150px;">
                        </div>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <p hidden>{{$obat->id}}</p>
                                <h5 class="fw-bolder">{{$obat->nm_obat}}</h5>
                                <p hidden>{{$obat->qty}}</p>
                                <!-- Product price-->
                                Rp. {{$obat->harga}}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <button class="btn btn-primary mt-auto" onclick="addToCart('{{ $obat->id }}', '{{ $obat->nm_obat }}', '{{ $obat->qty }}', '{{ $obat->harga }}')"> Add to Cart </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-3 bg-dark fixed-bottom">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Apotek 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    var temporaryData = [];

    // Fungsi untuk menambahkan item ke keranjang
    function addToCart(id, nm_obat, qty, harga) {
        // Cari apakah item dengan nm_obat yang sama sudah ada di keranjang
        var existingItem = temporaryData.find(item => item.id === id);

        if (existingItem) {
            // Jika item sudah ada, tingkatkan jumlahnya (qty) dan perbarui sub_total
            existingItem.qty++;
            existingItem.sub_total = existingItem.qty * existingItem.harga;
        } else {
            // Jika item belum ada, tambahkan item baru
            var item = {
                id: id,
                nm_obat: nm_obat,
                qty: 1,
                harga: harga,
                sub_total: harga, // sub_total awal adalah harga
            };
            temporaryData.push(item);
        }

        // Perbarui tampilan keranjang
        updateCartView();
    }

    function deleteFromCart(index) {
        if (index >= 0 && index < temporaryData.length) {
            temporaryData.splice(index, 1); // Remove the item at the specified index
            updateInvoiceTable(); // Update the cart view
        }
    }

    // Fungsi untuk memperbarui tampilan keranjang
    function updateCartView() {
        var temporaryDataDiv = document.getElementById("temporaryData");
        temporaryDataDiv.innerHTML = "";

        if (temporaryData.length === 0) {
            temporaryDataDiv.innerHTML = "<p>Keranjang kosong</p>";
        } else {
            var ul = document.createElement("ul");
            var totalHarga = 0; // Tambahkan variabel totalHarga

            temporaryData.forEach((item) => {
                // Hitung total harga
                totalHarga += item.sub_total;

                var li = document.createElement("li");
                li.textContent = `${item.nm_obat} - Rp. ${item.sub_total}`;
                ul.appendChild(li);
            });

            temporaryDataDiv.appendChild(ul);
            temporaryDataDiv.innerHTML += '<p>Total: Rp. ${totalHarga.toFixed(2)}</p>'; // Menampilkan total harga

            var badgeSpan = document.querySelector(".badge");

            // Hitung total item dalam keranjang
            var totalItemsInCart = temporaryData.length;

            // Perbarui teks dalam elemen span dengan total item
            badgeSpan.textContent = totalItemsInCart;
        }
    }

    function closeInvoice() {
        var invoiceModal = document.getElementById('invoiceModal');
        invoiceModal.style.display = 'none';
        updateCartView()
    }

    // Fungsi untuk menampilkan invoice
    function showInvoice() {
        updateInvoiceTable();
        var invoiceModal = document.getElementById('invoiceModal');
        invoiceModal.style.display = 'block';
    }

    // Fungsi untuk memperbarui tabel invoice
    function updateInvoiceTable() {
        var invoiceTableBody = document.getElementById('temporaryData');
        invoiceTableBody.innerHTML = '';
        var totalHarga = 0; // Tambahkan variabel totalHarga

        temporaryData.forEach(function(item, index) {
            var row = invoiceTableBody.insertRow();

            // Menampilkan nomor urut, nama barang, qty, harga, dan sub_total
            var cellNumber = row.insertCell(0);
            cellNumber.innerHTML = index + 1;

            var cellNmObat = row.insertCell(1);
            cellNmObat.innerHTML = item.nm_obat;

            var cellQty = row.insertCell(2);
            cellQty.innerHTML = item.qty;

            var cellHarga = row.insertCell(3);
            cellHarga.innerHTML = item.harga;

            var cellSubTotal = row.insertCell(4);
            cellSubTotal.innerHTML = item.sub_total;

            // Delete button
            var cellDelete = row.insertCell(5);
            var deleteButton = document.createElement('button');
            deleteButton.innerText = 'Delete';
            deleteButton.className = 'btn btn-danger';
            deleteButton.onclick = function() {
                deleteFromCart(index); // Call the delete function when the button is clicked
            };
            cellDelete.appendChild(deleteButton);

            // Mengonversi sub_total ke angka desimal
            item.sub_total = parseFloat(item.sub_total);

            // Menambahkan sub_total ke totalHarga
            totalHarga += item.sub_total;
        });

        // Mengupdate invoiceGrandTotal
        var invoiceGrandTotal = document.getElementById('invoiceGrandTotal');
        invoiceGrandTotal.value = 'Rp ' + totalHarga.toFixed(2);
    }


    // Fungsi untuk menambahkan item ke keranjang melalui AJAX
    function saveToCart(nm_obat, qty, harga, sub_total) {
        $.ajax({
            type: 'POST',
            url: '{{ route("transaksi.store") }}',
            data: {
                nm_obat: nm_obat,
                qty: qty,
                harga: harga,
                sub_total: sub_total,
            },
            success: function(item) {
                // Penanganan respons dari server
                alert(item.message);
            },
        });
    }
</script>

</html>