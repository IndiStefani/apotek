@extends('layouts.app')
@section('content')


<!-- Content Header (Page header) -->
<div class="row align-items-center">
    <div class="col">
        <h3 class="page-title">Daftar Kategori</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Kategori</li>
        </ul>
    </div>
    <div class="col-auto float-right ml-auto mt-5">
        <!-- Tombol untuk memicu modal -->
        <a class="btn btn-primary" style="color : white" data-toggle="modal" data-target="#addCategoryModal">Tambah Kategori</a>
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
                                <tr>
                                    <th style="width: 10px;" class="text-center">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategoriList as $key=>$kategori)
                                <tr class="align-middle text-center">
                                    <td>{{$key+1}}</td>
                                    <td>{{$kategori->nm_kategori}}</td>
                                    <td>
                                        <a href="{{ route('super.kategoriEdit', ['kategori' => $kategori->id]) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('super.kategoriDestroy', $kategori->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this kategori?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Modal untuk menambah kategori -->
                        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Isi formulir kategori di sini -->
                                        <form action="{{ route('super.kategoriStore') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nm_kategori">Nama Kategori</label>
                                                <input type="text" class="form-control" id="nm_kategori" name="nm_kategori" required>
                                            </div>

                                            <!-- Tambahkan lebih banyak bidang jika diperlukan -->

                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>

<script>
    $(document).ready(function() {
        // Aktifkan modal saat tombol "Tambah" diklik
        $(".btn-add-category").on("click", function() {
            $('#addCategoryModal').modal('show');
        });
    });
</script>



@endsection