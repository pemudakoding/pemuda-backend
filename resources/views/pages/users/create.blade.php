@extends('layouts.default')
@section('page','Tambah User')

@section('content')
    <div class="card">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header d-flex justify-content-between">
                <strong>Tambah User</strong>
                <button class="btn btn-primary btn-sm" type="submit">Tambah User</button>
            </div>
            <div class="card-body card-block">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama Lengkap</label>
                            <input 	type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" />
                            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email" class="form-control-label">E-mail</label>
                            <input 	type="text"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" />
                            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <input 	type="text"
                                    name="username"
                                    value="{{ old('username') }}"
                                    class="form-control @error('username') is-invalid @enderror" />
                            @error('username') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input 	type="password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    class="form-control @error('password') is-invalid @enderror" />
                            @error('password') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-control-label">Konfirmasi Password</label>
                            <input 	type="password"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" />
                            @error('password_confirmation') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="level" class="form-control-label">jabatan</label>
                            <select name="levels_id" id="select" class="form-control">
                                <option value="">Please select</option>
                                @foreach ($items as $item)
                                    @if (old('levels_id') == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->level}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->level}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="photo" class="form-control-label">Foto Profil</label>
                            <input 	type="file"
                                    accept="image/*"
                                    name="photo"
                                    value="{{ old('photo') }}"
                                    class="form-control @error('photo') is-invalid @enderror" />
                            @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
