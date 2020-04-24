@extends('layouts.default')

@section('content')
	<div class="card">
        <form action="{{ route('products.update',['product' => $item->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header d-flex justify-content-between">
                <strong>Ubah Produk <small>{{ $item->name }}</small></strong>
                <button class="btn btn-primary btn-sm" type="submit">Ubah produk</button>
            </div>
		    <div class="card-body card-block">
				<div class="form-group">
					<label for="name" class="form-control-label">Nama Barang</label>
					<input 	type="text"
							name="name"
							value="{{ old('name') ?? $item->name }}"
							class="form-control @error('name') is-invalid @enderror" />
					@error('name') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
				<div class="form-group">
					<label for="type" class="form-control-label">Tipe Barang</label>
					<input 	type="text"
							name="type"
							value="{{ old('type') ?? $item->type }}"
							class="form-control @error('type') is-invalid @enderror" />
					@error('type') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
				<div class="form-group">
					<label for="description" class="form-control-label">Deskripsi Barang</label>
					<textarea 	name="description"
								class="ckeditor form-control @error('description') is-invalid @enderror">{{ old('description') ?? $item->description }}</textarea>
					@error('description') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
				<div class="form-group">
					<label for="price" class="form-control-label">Harga Barang</label>
					<input 	type="number"
							name="price"
							value="{{ old('price') ?? $item->price }}"
							class="form-control @error('price') is-invalid @enderror" />
					@error('price') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
				<div class="form-group">
					<label for="quantity" class="form-control-label">Jumlah Barang</label>
					<input 	type="number"
							name="quantity"
							value="{{ old('quantity') ?? $item->quantity }}"
							class="form-control @error('quantity') is-invalid @enderror" />
					@error('quantity') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
            </div>
        </form>
	</div>
@endsection

@push('after-script')
	<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
	<script>
		ClassicEditor
	        .create( document.querySelector( '.ckeditor' ) )
	        .then( editor => {
	                console.log( editor );
	        } )
	        .catch( error => {
	                console.error( error );
	        } );
	</script>
@endpush
