@extends('admins.inc.mastertables')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">
				<h1 class="h3 mb-3"><strong>Transactions History</strong> Table</h1>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Transactions History</h5>
								</div>
								<div class="card-body">
								@if (!empty($transactionHistory))
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Staff ID</th>
											<th>Staff Names</th>
											<th>Transaction Date</th>
											<th>Purpose</th>
											<th>Description</th>
											<th>Amount</th>
											<th>Balance</th>
											<th>Transaction Type</th>
											<th>Type</th>
											
										</tr>
									</thead>
									<tbody>
											@foreach ($transactionHistory as $transaction)
												<tr>
													<td>{{ $transaction->id }}</td>
													<td>{{ $transaction->staff_id }}</td>
													<td>{{ $transaction->f_staff_name }} {{ $transaction->l_staff_name }}</td>
												
													<td>{{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</td>

													<td>{{ $transaction->purpose }}</td>
													<td>{{ $transaction->description }}</td>
													<td>{{ $transaction->amount }}</td>
													<td>{{ $transaction->balance }}</td>
													<td>{{ $transaction->transaction_type }}</td>
													<td>
														@if ($transaction->transaction_type !== 'top-up')
															<span class="badge bg-success">Debit</span>
														@else
															<span class="badge bg-danger">Credit</span>
														@endif
													</td>
													
												</tr>
											@endforeach
										</tbody>
									</table>
									@else
									<p>No transaction data available.</p>
								@endif
									
								</div>
							</div>

				</div>
				
			</main>
@endsection