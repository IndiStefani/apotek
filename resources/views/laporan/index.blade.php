@extends('layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Laporan Penjualan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <a class="btn btn-primary btn-md mt-4 mb-3" href="{{ route('laporan.create') }}" role="button">
                Tambah Laporan
            </a>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table_id" border=1 class="display">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px;" class="text-center">No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penjualanList as $key=>$penjualan)
                                    <tr class="align-middle text-center">
                                        <td>{{$key+1}}</td>
                                        <td>{{$penjualan->kd_transaksi}}</td>
                                        <td>
                                            <a href="{{ route('laporan.edit', ['penjualan' => $penjualan->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('laporan.destroy', $penjualan->id) }}" method="POST" style="display: inline;">
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
    