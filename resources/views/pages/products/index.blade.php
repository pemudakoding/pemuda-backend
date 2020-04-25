@extends('layouts.default')
@section('page','Daftar Produk')

@section('content')
    @include('includes.alert')
	<div class="orders">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body d-flex justify-content-between">
						<h4 class="box-title">Daftar Produk</h4>
						<a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm">Tambah Produk</a>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama</th>
										<th>Tipe</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->name }}</td>
										<td>{{ $item->type }}</td>
										<td>{{ $item->price }}</td>
										<td>{{ $item->quantity }}</td>
										<td>
											<a href="{{ route('products.gallery',$item->id) }}" class="btn btn-info btn-sm">
												<i class="fa fa-picture-o"></i>
											</a>
											<a href="{{ route('products.edit',['product' => $item->id]) }}" class="btn btn-primary btn-sm">
												<i class="fa fa-pencil"></i>
											</a>
											<form action="{{ route('products.destroy',['product' => $item->id]) }}" method="POST" class="d-inline">
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
                {{ $items->links('vendor.pagination.semantic-ui') }}
			</div>
		</div>
	</div>
@endsection
