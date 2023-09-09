@extends('admins.inc.mastertables')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">
				<h1 class="h3 mb-3"><strong>Allocation History</strong> Table</h1>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Allocation History</h5>
								</div>
								<div class="card-body">
								@if (!empty($allocationHistory))
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Staff ID</th>
											<th>Staff Names</th>
											<th>Transaction Date</th>											
											<th>Amount</th>								
											<th>Type</th>
											
										</tr>
									</thead>
									<tbody>
											@foreach ($allocationHistory as $transaction)
												<tr>
													<td>{{ $transaction->id }}</td>
													<td>{{ $transaction->staff_id }}</td>
													<td>{{ $transaction->f_staff_name }} {{ $transaction->l_staff_name }}</td>
													
													<td>{{ date('d-m-Y H:i:s', strtotime($transaction->allocation_date)) }}</td>
												
													<td>{{ $transaction->allocated_amount }}</td>												
													<td>					
															<span class="badge bg-success">Debit</span>
													</td>
													
												</tr>
											@endforeach
										</tbody>
									</table>
									@else
									<p>No Allocation data available.</p>
								@endif
									
								</div>
							</div>

				</div>
				
			</main>
@endsection