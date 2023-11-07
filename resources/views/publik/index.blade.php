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
    <!-- Navbar -->
    <div class="container-fluid fixed-top m-0 p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#!" style="margin-right: auto;">Apotek</a>
            <!-- search -->
            <form class="form-inline ml-auto" id="search-form">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search-input">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="search-button">Search</button>

                <!-- cart -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex float-right">
                        <div id="cart">
                            <button class="btn btn-outline-dark bi-cart-fill" type="button" onclick="showInvoice()">
                                Cart
                                <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-badge">0</span>
                            </button>
                        </div>
                    </form>
                </div>
            </form>
        </nav>
    </div>

    <!-- Header-->
    <!-- <header class="bg-dark py-5 mt-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header> -->

    <!-- menampilkan modal -->
    <div id="invoiceModal" class="modal" style="display: none;">
        <div class="modal-content" style="height: 100%; width: 100%; background-color: white;">
            <div class="row mt-5">
                <form action="{{ route('publik.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                        <!-- Cekout -->
                        <div class="col-lg-7">
                            <h5 class="mb-3"><a href="#!" onclick="closeInvoice()" class="text-body"><i class="fa fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>

                            <div class="text-center">
                                <h1>Checkout</h1>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 20%;">Nama Barang</th>
                                            <th>Qty</th>
                                            <th style="width: 20%;">Harga Barang</th>
                                            <th style="width: 20%;">Sub Total</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="temporaryData">
                                        <!-- Data temporaryData akan ditampilkan di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- transaksi -->
                        <div class="col-lg-5">
                            <div class="card bg-primary text-white rounded-3">
                                <div class="card-body">
                                    <form class="mt-4">
                                        <div class="form-outline form-white mb-4">
                                            <input type="text" id="nm_klien" name="nm_klien" required="required" class="form-control form-control-lg" siez="20" placeholder="Nama Pelanggan" />
                                            <label class="form-label" for="typeName">Nama Pelanggan</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input type="text" id="alamat" name="alamat" required="required" class="form-control form-control-lg" size="25" placeholder="Alamat" minlength="25" maxlength="25" />
                                            <label class="form-label" for="typeText">Alamat</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input type="text" id="telp" name="telp" required="required" class="form-control form-control-lg" placeholder="+62 **** **** ****" size="12" minlength="10" maxlength="12" />
                                            <label class="form-label" for="typeExp">No. Telp</label>
                                        </div>
                                    </form>

                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-2">Total(Incl. taxes)</p>
                                        <p class="mb-2"><span id="grand_total"></span></p>
                                    </div>

                                    <button type="button" class="btn btn-info btn-block btn-lg" onclick="saveData()">
                                        Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Section-->
    <section class="py-5" style="margin-top: 60px;" id="search-results">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($obat as $key=>$obat)
                <div class="col obat" data-nm_obat="{{ strtolower($obat->nm_obat) }}">
                    <div class="card text-center">
                        <div class="d-flex align-items-center justify-content-center" style="max-width:300px">
                            <div style="width: 150px; height: 150px; overflow: hidden;">
                                <img class="card-img-top" src="{{ asset('image/' . $obat->poster) }}" alt="{{ $obat->nm_obat }}" style="max-width: 150px; max-height: 150px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-tittle">{{$obat->nm_obat}}</h5>
                            <p hidden>{{$obat->qty}}</p>
                            <!-- Product price-->
                            Rp. {{$obat->harga}}
                        </div>
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
    <div class="container-fluid m-0 p-0">
        <footer class="text-center text-lg-start text-white" style="background-color: #d3d3d3;">
            <!-- Copyright -->
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Copyright &copy;
                <a class="text-white" href="#">Apotek <?php echo date('Y'); ?></a>
            </div>
            <!-- Copyright -->
        </footer>

    </div>
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
            var totalItems = 0; // Menambah variabel totalItems

            temporaryData.forEach((item) => {
                // Hitung total harga
                totalHarga += item.sub_total;

                var li = document.createElement("li");
                li.textContent = `${item.nm_obat} - Rp. ${item.sub_total}`;
                ul.appendChild(li);
            });

            temporaryDataDiv.appendChild(ul);
            temporaryDataDiv.innerHTML += '<p>Total: Rp. ${totalHarga.toFixed(2)}</p>'; // Menampilkan total harga
            var badgeSpan = document.getElementById("cart-badge"); // Menggunakan id yang baru
            badgeSpan.textContent = totalItems; // Memperbarui jumlah item di keranjang

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

        // Mengupdate grand_total
        var grand_total = document.getElementById('grand_total');
        grand_total.value = totalHarga.toFixed(2);
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



    // Bagian JavaScript
    function searchObat(query) {
        query = query.toLowerCase();

        // Mencari obat yang cocok dengan query
        var results = [];

        // Loop melalui elemen-elemen dengan class 'obat' yang ada dalam HTML
        var obatElements = document.querySelectorAll('.obat');

        obatElements.forEach(function(obatElement) {
            var nm_obat = obatElement.getAttribute('data-nm_obat');

            if (nm_obat.includes(query)) {
                results.push({
                    nm_obat: nm_obat,
                    // Tambahkan atribut lain jika diperlukan
                });
            }
        });

        return results;
    }

    function displaySearchResults(results) {
        var searchResults = document.getElementById('search-results');
        searchResults.innerHTML = '';

        if (results.length === 0) {
            searchResults.innerHTML = '<p>No results found.</p>';
        } else {
            var ul = document.createElement('ul');
            results.forEach(function(result) {
                var li = document.createElement('li');
                li.textContent = result.nm_obat;
                ul.appendChild(li);
            });
            searchResults.appendChild(ul);
        }
    }

    // Tangani klik pada tombol pencarian
    var searchButton = document.getElementById('search-button');
    searchButton.addEventListener('click', function() {
        var searchInput = document.getElementById('search-input');
        var searchTerm = searchInput.value;
        var searchResults = searchObat(searchTerm);
        displaySearchResults(searchResults);
    });

    // Tangani perubahan pada input pencarian saat pengguna mengetikkan
    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function() {
        var searchTerm = searchInput.value;
        var searchResults = searchObat(searchTerm);
        displaySearchResults(searchResults);
    });


    // Fungsi untuk menyimpan data
    function saveData() {
        // Generate Kode Transaksi
        var kd_transaksi = 'KR-' + new Date().getTime();

        // Mengambil data sementara
        var nm_klien = document.getElementById('nm_klien').value;
        var alamat = document.getElementById('alamat').value;
        var telp = document.getElementById('telp').value;
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
        console.log(details, kd_transaksi, nm_klien, alamat, telp);

        // Kirim data ke server menggunakan Ajax
        $.ajax({
            type: 'POST',
            url: '{{ route("publik.store") }}',
            data: {
                kd_transaksi: kd_transaksi,
                nm_klien: nm_klien,
                alamat: alamat,
                telp: telp,
                total_harga: total_harga,
                details: details,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                alert('Data berhasil disimpan. Kode Transaksi: ' + kd_transaksi);
                window.location.href = '{{route("publik.index")}}';
            },
            error: function(error) {
                console.error('Error saving data:', error);
                alert('Gagal menyimpan data.');
            }
        });
    };
</script>

</html>