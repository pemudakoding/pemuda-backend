@extends('layouts.default')

@section('content')
	<div class="card">
        <form action="{{ route('hero-apps.update',$item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header d-flex justify-content-between">
                <strong>Ubah Landing Page</strong>
                <button class="btn btn-primary btn-sm" type="submit">Ubah Landing Page</button>
            </div>
		    <div class="card-body card-block">
				<div class="form-group">
					<label for="title" class="form-control-label">Judul Landing Page</label>
					<input 	type="text"
							name="title"
							value="{{ old('title') ?? $item->title }}"
							class="form-control @error('title') is-invalid @enderror" />
					@error('title') <div class="text-muted">{{ $message }}</div> @enderror
				</div>
                <div class="form-group">
                    <label for="description" class="form-control-label">Deskripsi Landing Page</label>
                    <textarea 	name="description"
                                class="ckeditor form-control @error('description') is-invalid @enderror">
                                {{ old('description') ?? $item->description}}
                    </textarea>
                    @error('description') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
				<div class="form-group">
					<label for="type" class="form-control-label">Tipe Landing Page</label>
					<input 	type="text"
							name="type"
							value="{{ old('type') ?? $item->type }}"
							class="form-control @error('type') is-invalid @enderror" />
					@error('type') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
					<label for="background" class="form-control-label">Background Landing Page</label>
					<input 	type="file"
							name="background"
							class="form-control @error('background') is-invalid @enderror" />
					@error('background') <div class="text-muted">{{ $message }}</div> @enderror
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
