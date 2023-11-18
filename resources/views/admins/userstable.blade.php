@extends('admins.inc.mastertables')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>PettyCash</strong> Users Table</h1>
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
									<h5 class="card-title mb-0">User registration</h5>
								</div>
								<div class="card-body">
									<!-- Button to trigger modal -->
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
										Register User
										</button>

										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">User Registration</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<!-- Registration Form -->
												<form method="POST" action="{{ route('registerUser') }}" class="signin-form">
								
												@csrf

												<div class="form-group mt-3">
													<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
													<label class="form-control-placeholder" for="names">Full Names</label>
												</div>

												<div class="form-group mt-3">
													<input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
													<label class="form-control-placeholder" for="email">Email Address</label>
												</div>

												<div class="form-group mt-3">
													<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
													<label class="form-control-placeholder" for="phone">Phone no (country code)</label>
												</div>

												<div class="form-group mt-3">
													<input type="text" class="form-control" name="country" value="{{ old('country') }}" required>
													<label class="form-control-placeholder" for="username">Country</label>
												</div>

												<!-- <div class="form-group mt-3">
													<select class="form-control" name="country1" value="{{ old('country1') }}" required>
													<option value="" ></option>
													@php
													$countries=[];
													@endphp
													@foreach ($countries as $country)
														<option value="{{ $country->country_id }}">  {{ $country->country_name }}</option>
													@endforeach
													</select>
													<label class="form-control-placeholder" for="username">Country</label>
												</div> -->

												<div class="form-group mt-3">
													<input type="text" class="form-control" name="position" value="{{ old('position') }}" required>
													<label class="form-control-placeholder" for="positon">Position</label>
												</div>

												<div class="form-group">
													<input id="password-field" type="password" class="form-control" name="password" required>
													<label class="form-control-placeholder" for="password">Password</label>
													
												</div>

												<div class="form-group">
													<input id="password-field" type="password" class="form-control" name="password_confirmation" required>
													<label class="form-control-placeholder" for="password">Confirm Password</label>
													
												</div>

												<!-- Add other form fields here -->

												
												<div class="form-group d-md-flex">
												</div>
												
												<!-- End Registration Form -->
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Register User</button>
											</div>
											</form>
											</div>
										</div>
										</div>

								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Users In the System</h5>
									<h6 class="card-subtitle text-muted">This Shows the available users in the system</h6>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Email</th>
												<th>Country</th>
												<th>Position</th>
												<th>Role</th>
												<th>Registered At</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($users as $user)
												<tr>
													<td>{{ $user->id }}</td>
													<td>{{ $user->name }}</td>
													<td>{{ $user->email }}</td>
													<td>{{ $user->country }}</td>
													<td>{{ $user->position }}</td>
													<td>{{ $user->role }}</td>
													<td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
													<td> 
													<a href="#viewAgentModal{{$user->id}}" title="View Client" data-toggle="modal" class="btn btn-success"><i class="fa fa-eye"></i> </a> 
													<a href="#editUserModal{{$user->id}}" title="Edit User" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
													<a href="#changePasswordModal{{$user->id}}" title="Change Password" data-toggle="modal" class="btn btn-primary"><i class="fa fa-key"></i></a>

														@include('admins.modals.modalusers')
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