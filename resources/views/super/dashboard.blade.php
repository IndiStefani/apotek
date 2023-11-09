@extends('layouts.app')
@section('content')

<!-- partial -->
<section class="content">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between card-group justify-content-center">
                                        <div class="card text-center mx-2 mb-3">
                                            <p class="statistics-title mt-3">User</p>
                                            <h3 class="rate-percentage mb-3">{{ $totalUsers }}</h3>
                                        </div>
                                        <div class="card text-center mx-2 mb-3">
                                            <p class="statistics-title mt-3">Kategori Obat</p>
                                            <h3 class="rate-percentage mb-3">{{ $totalKategoris }}</h3>
                                        </div>
                                        <div class="card text-center mx-2 mb-3">
                                            <p class="statistics-title mt-3">Jumlah Obat</p>
                                            <h3 class="rate-percentage mb-3">{{ $totalObats }}</h3>
                                        </div>
                                        <div class="card text-center mx-2 mb-3">
                                            <p class="statistics-title mt-3">Transaksi</p>
                                            <h3 class="rate-percentage mb-3">{{ $totalTransaksis }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container-fluid">
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Obat Overview</h4>
                                                            <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                                        </div>
                                                        <div>
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> This month </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                    <h6 class="dropdown-header">Settings</h6>
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                        <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                            <h2 class="me-2 fw-bold">$36,2531.00</h2>
                                                            <h4 class="me-2">USD</h4>
                                                            <h4 class="text-success">(+1.37%)</h4>
                                                        </div>
                                                        <div class="me-3">
                                                            <div id="marketing-overview-legend"></div>
                                                        </div>
                                                    </div>
                                                    <div class="chartjs-bar-wrapper mt-3">
                                                        <canvas id="obatChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</section>
<!-- main-panel ends -->

<script>
    // Mengambil data obat dari rute /obat-data
    fetch('{{route("super.obatData")}}')
        .then(response => response.json())
        .then(data => {
            var labels = data.map(obat => obat.nm_obat); // Ambil nama obat
            var quantities = data.map(obat => obat.stok); // Ambil jumlah stok obat

            var obatData = {
                labels: labels,
                datasets: [{
                    label: "Jumlah Stok Obat",
                    data: quantities,
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                }],
            };

            var stepSize = 10;
            // Inisialisasi dan konfigurasi grafik
            var ctx = document.getElementById("obatChart").getContext("2d");
            var obatChart = new Chart(ctx, {
                type: "bar",
                data: obatData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: stepSize, // Set kelipatan sumbu Y
                                min: 0 // Pastikan dimulai dari 0
                            },
                        },
                    },
                },
            });
        });
</script>



@endsection