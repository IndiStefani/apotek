@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    You are a Super Admin.
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="content-wrapper" style="background: gray;">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="background: #ffc107;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Surat Masuk</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="background: #ffc107;">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th>Gambar</th>
                                        <th>Nama Obat</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allSuratMasuk as $key=>$obat)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$obat->Poster}}</td>
                                        <td>{{$obat->Nama}}</td>
                                        <td>{{$obat->Kategori}}</td>
                                        <td>{{$obat->Jumlah}}</td>
                                        <td>{{$obat->Harga}}</td>
                                        <td>
                                            <div class="btn btn-primary" href="{{route('obat.show', $obat->id)}}">
                                                <i class="fas fa-eye"></i>
                                                Lihat
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </section>

    @endsection