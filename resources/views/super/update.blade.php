@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Obat</h1>
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
                            <form action="{{ route('super.update', ['obat' => $obat->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Nama Obat Input -->
                                <div class="form-group">
                                    <label for="nama">Nama Obat:</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $obat->nama }}" required>
                                </div>

                                <!-- Description Input -->
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi:</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('description', $obat->description) }}</textarea>
                                </div>

                                <!-- Kategori Input -->
                                <div class="form-group">
                                    <label for="kategori">Kategori:</label>
                                    <select name="kategori_id" id="kategori" class="form-control" value="{{ $obat->nama }}" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach ($kategoriList as $key=>$kategori)
                                        <option value="{{ $kategori->id }}">{{$kategori->nm_kategori}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Jumlah Input -->
                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $obat->jumlah }}" required>
                                </div>

                                <!-- Harga Input -->
                                <div class="form-group">
                                    <label for="harga">Harga:</label>
                                    <input type="number" name="harga" id="harga" class="form-control" value="{{ $obat->harga }}" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Obat</button>
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
