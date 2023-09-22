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
                            <form action="{{ route('super.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Gambar Input -->
                                <div class="form-group">
                                    <label for="poster">Gambar:</label>
                                    <input type="file" name="poster" id="poster" class="form-control" required>
                                </div>

                                <!-- Nama Obat Input -->
                                <div class="form-group">
                                    <label for="nama">Nama Obat:</label>
                                    <input type="text" name="nm_obat" id="nama" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori:</label>
                                    <select name="kategori_id" id="kategori" class="form-control" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach ($kategoriList as $key=>$kategori)
                                        <option value="{{ $kategori->id }}">{{$kategori->nm_kategori}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Jumlah Input -->
                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" name="stok" id="stok" class="form-control" required>
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