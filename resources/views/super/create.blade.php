@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Obat Baru</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('superobat.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Gambar Input -->
                                <div class="form-group">
                                    <label for="poster">Gambar:</label>
                                    <input type="file" name="poster" id="poster" class="form-control" required>
                                </div>

                                <!-- Nama Obat Input -->
                                <div class="form-group">
                                    <label for="nama">Nama Obat:</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>

                                <!-- Kategori Input -->
                                <div class="form-group">
                                    <label for="kategori">Kategori:</label>
                                    <input type="text" name="kategori" id="kategori" class="form-control" required>
                                </div>

                                <!-- Jumlah Input -->
                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                </div>

                                <!-- Harga Input -->
                                <div class="form-group">
                                    <label for="harga">Harga:</label>
                                    <input type="number" name="harga" id="harga" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Obat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
