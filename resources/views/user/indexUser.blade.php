@extends('layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Daftar User</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar User</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto mt-5">
                <a href="{{ route('user.userCreate') }}" class="btn btn-primary">Tambah User</a>
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
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Usertype</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key=>$user)
                                        <tr class="align-middle text-center">
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->usertype}}</td>
                                            <td>
                                                <a href="{{ route('user.userEdit', ['user' => $user->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('user.userDestroy', $user->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
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