@extends('layouts.default')
@section('page','Daftar User')

@section('content')
    @include('includes.alert')
	<div class="orders">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body d-flex justify-content-between">
						<h4 class="box-title">Daftar User </h4>
						<a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-sm">Tambah User</a>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama</th>
										<th>Username</th>
										<th>Jabatan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>
                                            {{$item->name}}
										</td>
                                        <td>{{ $item->username }}</td>
										<td>
											{{ $item->level->level ?? 'Moderator' }}
										</td>
										<td>
                                            <a href="{{ route('users.edit', $item->id) }}" class="btn btn-primary btn-sm">
												<i class="fa fa-pencil"></i>
											</a>
											<form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline">
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
