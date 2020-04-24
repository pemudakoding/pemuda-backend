@extends('layouts.default')

@section('content')
	<div class="card">
        <form action="{{ route('product-galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header d-flex justify-content-between">
                <strong>Tambah Foto Produk</strong>
                <button class="btn btn-primary btn-sm" type="submit">Tambah Foto Produk</button>
            </div>
		    <div class="card-body card-block">
				<div class="form-group">
					<label for="name" class="form-control-label">Nama Barang</label>
					<select name="products_id"
							class="form-control @error('products_id') is-invalid @enderror">

						@foreach ($products as $product)
							<option value="{{ $product->id }}">{{ $product->name }}</option>
						@endforeach
					</select>
					@error('products_id') <div class="text-muted">{{ $message }}</div> @enderror
				</div>

				<div class="form-group">
					<label for="photo" class="form-control-label">Foto Barang</label>
					<input 	type="file"
							accept="image/*"
							name="photo"
							value="{{ old('photo') }}"
							class="form-control @error('photo') is-invalid @enderror" />
					@error('photo') <div class="text-muted">{{ $message }}</div> @enderror
				</div>

				<div class="form-group">
					<label for="is_default" class="form-control-label">Jadikan Default</label>
					<br>

					<div class="form-check">
					    <input 	type="radio"
								name="is_default"
								value="1"
								class="form-check-input @error('is_default') is-invalid @enderror"/>
					    <label class="form-check-label mr-4" >Ya</label>

					    <input 	type="radio"
								name="is_default"
								value="0"
								class="form-check-input @error('is_default') is-invalid @enderror"/>
					    <label class="form-check-label" >tidak</label>
					</div>
					@error('is_default') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
            </div>
        </form>
	</div>
@endsection
