@extends('layouts.default')

@section('content')
    @include('includes.alert')
    <div class="alert alert-info" role="alert">
        Batas Landing Page maksimal 3
        dan minimal 1. ini mempengaruhi halaman depan aplikasi kalian
    </div>
	<div class="orders">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body d-flex justify-content-between">
						<h4 class="box-title">Daftar Landing Page</h4>
						<a href="{{ route('hero-apps.create') }}" class="btn btn-outline-primary btn-sm">Tambah Landing Page</a>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>#</th>
										<th>Background</th>
										<th>Judul</th>
										<th>Tipe</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>
                                            <img src="{{$item->background}}" alt="{{ $item->title }}" width=200>
                                        </td>
										<td>{{ $item->title }}</td>
										<td>{{ $item->type }}</td>
										<td>
											<a href="{{ route('hero-apps.edit',$item->id) }}" class="btn btn-primary btn-sm">
												<i class="fa fa-pencil"></i>
											</a>
											<form action="{{ route('hero-apps.destroy', $item->id) }}" method="POST" class="d-inline">
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
