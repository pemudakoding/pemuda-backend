@extends('layouts.default')


@section('content')
    @include('includes.alert')
	<div class="orders">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Daftar Transaksi Masuk</h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Nomor</th>
										<th>Total Transaksi</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($items as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->name }}</td>
										<td>{{ $item->email }}</td>
										<td>{{ $item->number }}</td>
										<td>${{ $item->transaction_total }}</td>
										<td>
											@if( $item->transaction_status === "PENDING" )
												<span class="badge badge-info">
											@elseif( $item->transaction_status === "SUCCESS" )
												<span class="badge badge-success">
											@elseif( $item->transaction_status === "FAILED" )
												<span class="badge badge-danger">
											@endif
													{{ $item->transaction_status }}
												</span>
										</td>
										<td>

											@if($item->transaction_status == "PENDING")
												<a 	href="{{ route('transactions.status',$item->id) }}?status=SUCCESS"
													class="btn btn-success btn-sm">
													<i class="fa fa-check"></i>
												</a>
												<a 	href="{{ route('transactions.status',$item->id) }}?status=FAILED"
													class="btn btn-warning btn-sm">
													<i class="fa fa-times"></i>
												</a>
											@endif
											<a 	href="#transactionModal"
												class="btn btn-info btn-sm"
												data-remote='{{ route('transactions.show',['transaction' => $item->id]) }}'
												data-toggle='modal'
												data-target='#transactionModal'
												data-title='Detail Transaksi {{ $item->uuid }}'>
												<i class="fa fa-eye"></i>
											</a>
											<a href="{{ route('transactions.edit',['transaction' => $item->id]) }}" class="btn btn-primary btn-sm">
												<i class="fa fa-pencil"></i>
											</a>
											<form action="{{ route('transactions.destroy',['transaction' => $item->id]) }}" method="POST" class="d-inline">
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

@push('after-script')
	<script>
		jQuery(document).ready(function($){
			$('#transactionModal').on('show.bs.modal', function(e){
				let button = e.relatedTarget;
				let modal  = $(this)

				modal.find('.modal-body').load(button.dataset.remote);
				modal.find('.modal-title').html(button.dataset.title);
			});
		});
	</script>

	<!-- Modal -->
	<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog"aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<i class="fa fa-spinner fa-spin"></i>
	      </div>
	    </div>
	  </div>
	</div>
@endpush


