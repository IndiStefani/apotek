@extends('layouts.app')
@section('content')

<!-- partial -->
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
    <!-- content-wrapper ends -->
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