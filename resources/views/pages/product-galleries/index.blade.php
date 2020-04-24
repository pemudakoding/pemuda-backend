@extends('layouts.default')

@section('content')
    @include('includes.alert')
	<div class="orders">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body d-flex justify-content-between">
						<h4 class="box-title">Daftar Foto Produk</h4>
						<a href="{{ route('product-galleries.create') }}" class="btn btn-outline-primary btn-sm">Tambah Foto</a>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Barang</th>
										<th>Foto</th>
										<th>Default</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->product->name }}</td>
										<td>
											<img src="{{ url($item->photo) }}" alt="" />
										</td>
										<td>
											{{ $item->is_default ? 'Ya' : 'Tidak' }}
										</td>
										<td>
											<form action="{{ route('product-galleries.destroy', $item->id) }}" method="POST" class="d-inline">
												@method('DELETE')
												@csrf

												<button class="btn btn-danger btn-sm">
													<i class="fa fa-trash"></i>
												</button>
											</form>
										</td>
									</tr>
									@empty
										<tr>
											<td colspan="6" class="text-center p-5">
												Data Tidak Tersedia
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
