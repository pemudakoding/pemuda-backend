@extends('layouts.default')

@section('content')
    @include('includes.alert')

    <div class="card">
        <form action="{{ route('app.update', $app->id) }}" method="POST" enctype="multipart/form-data">
            <div class="card-header d-flex justify-content-between">
                <strong>Pengaturan Aplikasi</strong>
                <button class="btn btn-primary btn-sm" type="submit">Perbarui Aplikasi</button>
            </div>
            <div class="card-body card-block">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="app_name" class="form-control-label">Nama Aplikasi</label>
                    <input  type="text"
                            name="app_name"
                            value="{{ old('app_name') ?? $app->app_name}}"
                            class="form-control @error('app_name') is-invalid @enderror" />
                    @error('app_name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="logo" class="form-control-label">Logo Aplikasi</label>
                    <input  type="file"
                            name="logo"
                            value="{{ old('logo_app') }}"
                            class="form-control @error('logo_app') is-invalid @enderror" />
                    @error('logo_app') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-control-label">Email </label>
                    <input  type="email"
                            name="email"
                            value="{{ old('email') ?? $app->email}}"
                            class="form-control @error('email') is-invalid @enderror" />
                    @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="number" class="form-control-label">No Hp/Telephone</label>
                    <input  type="text"
                            name="number"
                            value="{{ old('number') ?? $app->number}}"
                            class="form-control @error('number') is-invalid @enderror" />
                    @error('number') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="address" class="form-control-label">Alamat</label>
                    <input  type="text"
                            name="address"
                            value="{{ old('address') ?? $app->address}}"
                            class="form-control @error('address') is-invalid @enderror" />
                    @error('address') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="facebook" class="form-control-label">Facebook</label>
                            <input  type="text"
                                    name="facebook"
                                    value="{{ old('facebook') ?? $app->facebook}}"
                                    class="form-control @error('facebook') is-invalid @enderror" />
                            @error('facebook') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="instagram" class="form-control-label">Instagram</label>
                            <input  type="text"
                                    name="instagram"
                                    value="{{ old('instagram') ?? $app->instagram}}"
                                    class="form-control @error('instagram') is-invalid @enderror" />
                            @error('instagram') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="twitter" class="form-control-label">Twitter</label>
                            <input  type="text"
                                    name="twitter"
                                    value="{{ old('twitter') ?? $app->twitter}}"
                                    class="form-control @error('twitter') is-invalid @enderror" />
                            @error('twitter') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
