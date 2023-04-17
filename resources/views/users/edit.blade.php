@extends('adminlte::page')

@section('title', 'Edit Akun User | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Akun User</h1>
@stop

@section('content')
    <form action="{{route('users.update', $user)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="name" value="{{$user->name ?? old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{$user->email ?? old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" name="password">
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Konfirmasi Password" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputRole">Role</label>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        <select type="text" class="form-control @error('role') is-invalid @enderror" id="exampleInputRole" placeholder="Role" name="role" value="{{$user->role ?? old('role')}}">
                                    <?php if ($user->role =='admin'): ?>
                                            <Option value='admin' selected>admin</option>
                                            <Option value='user'>user</option>
                                    <?php else: ?>
                                            <Option value='user' selected>user</option>
                                            <Option value='admin'>admin</option>
                                    <?php endif?>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('users.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
