@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit User</h1>
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
                            <form action="{{ route('user.userUpdate', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Nama Obat Input -->
                                <div class="form-group">
                                    <label for="name">Nama User:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>

                                <!-- Email Input -->
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>

                                <!-- Password Input -->
                                <div class="form-group">
                                    <label for="password">Password Baru:</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password Baru">
                                </div>


                                <!-- Usertype Input -->
                                <input type="text" name="usertype" class="form-control" value="user" hidden>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update User</button>
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