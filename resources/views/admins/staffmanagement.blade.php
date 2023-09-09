@extends('admins.inc.mastertables')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Manage Staff</strong> Table</h1>

				@if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					<div class="alert-message">
						<strong>{{ $message }}</strong> 
					</div>
				</div>
				@endif

				@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					<div class="alert-message">
						<strong>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
						</strong> 
					</div>
				</div>	
				
				@endif


					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">
									<i class="fa fa-users" aria-hidden="true"></i> Register Staff
									</button>
									@include('admins.modals.registerstaffmodal')
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Manage staff List</h5>
									
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
											<th>Photo</th>
											<th>Staff Name</th>											
											<th>Phone</th>
											<th>Email</th>
											<th>Gender</th>											
											<th>Staff ID</th>
											<th>ID No</th>
											<th>Account Status</th>
											<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@php
											$ppt="";

											@endphp
											@foreach($staffData as $staff)
												
												<tr>
												<td>
													@if($staff->ppt_photo)
													<img src="{{ asset('storage/ppt/'.$staff->ppt_photo) }}" width="50" height="50" class="rounded-circle my-n1" alt="Avatar">
													@else
													No Photo Available
													@endif
												</td>
													<td>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</td>
													
													<td>{{ $staff->phone }}</td>
													<td>{{ $staff->email }}</td>
													<td>{{ $staff->gender }}</td>
													
													<td>{{ $staff->staff_id }}</td>
													<td>{{ $staff->id_no }}</td>
													<td>
														@if($staff->account_status == 'active')
															<span class="badge bg-success">Active</span>
														@elseif($staff->account_status == 'suspended')
															<span class="badge bg-danger">Suspended</span>
														@elseif($staff->account_status == 'Disabled')
															<span class="badge bg-warning">Disabled</span>
														
														@elseif($staff->account_status == 'Inactive')
															<span class="badge bg-warning">Inactive</span>
														@else
															<span class="badge bg-info">Unknown</span>
														@endif


													</td>
													<td> 
														
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection