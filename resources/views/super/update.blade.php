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

                                <!-- nm_obat Obat Input -->
                                <div class="form-group">
                                    <label for="nm_obat">Nama Obat:</label>
                                    <input type="text" name="nm_obat" id="nm_obat" class="form-control" value="{{ $obat->nm_obat }}" required>
                                </div>

                                <!-- Kategori Input -->
                                <div class="form-group">
                                    <label for="kategori">Kategori:</label>
                                    <select name="kategori_id" id="kategori" class="form-control" value="{{ $obat->kategori_id }}" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach ($kategoriList as $key=>$kategori)
                                        <option value="{{ $kategori->id }}" @if ($kategori->id == $obat->kategori_id) selected @endif>
                                            {{$kategori->nm_kategori}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- stok Input -->
                                <div class="form-group">
                                    <label for="stok">stok:</label>
                                    <input type="number" name="stok" id="stok" class="form-control" value="{{ $obat->stok }}" required>
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