@extends('account.inc.mastertables')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Ndururumo CBO Water</strong> Table</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Table Title</h5>
									<h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with
										DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/" target="_blank"
											rel="noopener noreferrer">here</a>.</h6>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Names</th>
												<th>Phone</th>
												<th>Gender</th>
												<th>ID No</th>
												<th>Email</th>
												<th>Mtr No</th>
												<th>Area</th>
												<th>Status</th>
												<th>Registration date</th>
											</tr>
										</thead>
										<tbody>
										@foreach ($clients_list as $data)
											<tr>
												<td> {{ $loop->iteration }}</td>
												<td>{{ $data->client_names }}</td>
												
												<td>{{ $data->phone }}</td>
												<td>{{ $data->gender }}</td>
												<td>{{ $data->IDNo }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ $data->mtr_no }}</td>
												<td>{{ $data->area }}</td>
												<td>{{ $data->staus }}</td>
												<td> {{ \Carbon\Carbon::parse($data->registration_date)->format('d-m-Y') }}</td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection