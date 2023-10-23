@extends('layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Daftar Obat</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Obat</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto mt-5">
                <!-- Tombol untuk memicu modal -->
                <a href="{{ route('super.create') }}" class="btn btn-primary">Tambah Obat</a>
            </div>
        </div>  

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-0">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table_id" class="display">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px;" class="text-center">No</th>
                                            <th>Gambar</th>
                                            <th>Nama Obat</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($obatList as $key=>$obat)
                                        <tr class="align-middle text-center">
                                            <td>{{$key+1}}</td>
                                            <td><img src="{{ asset('image/' .$obat->poster) }}" alt="{{$obat->nm_obat}}" width="100"></td>
                                            <td>{{$obat->nm_obat}}</td>
                                            <td>{{$obat->kategori->nm_kategori}}</td>
                                            <td>{{$obat->stok}}</td>
                                            <td>Rp. {{$obat->harga}}</td>
                                            <td>
                                                <a href="{{ route('super.edit', ['obat' => $obat->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('super.destroy', $obat->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this obat?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
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