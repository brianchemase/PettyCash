@extends('account.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Clients Billing </h1>

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

					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<strong>{{ $message }}</strong>
						</div>
					@endif
					@if(Session::has('fail'))
							<div class="alert alert-danger">{{Session::get('fail')}}</div>
						@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div class="row">
					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Get Client To Bill</h5>
									<h6 class="card-subtitle text-muted">Select Client for billing.</h6>
								</div>
								<div class="card-body">
									<form class="row row-cols-md-auto align-items-center" action="{{route('billingListpage')}}" method="GET" autocomplete="off">
										

										<div class="col-12">
											<label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
											<div class="input-group mb-2 mr-sm-6">
												<div class="input-group-text">Get Client</div>
												<select class="form-select" id="validationDefault04" name="q" required>
													<option selected disabled value="">Choose...</option>
													@forelse ($clients_list as $data)
													<!-- <option value="{{ $data->id_number }}">{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }} - {{ $data->loan_id }}</option> -->
													<option value="{{ $data->mtr_no }},{{ $data->id }}">{{ $data->client_names }}  - {{ $data->mtr_no }}</option>
													@empty
													<option value="" disabled>No Active Loans</option>
													@endforelse
												</select>
												<!-- <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username"> -->
											</div>
										</div>

										

										<div class="col-12">
											<button type="submit" class="btn btn-primary mb-2">Search Client</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					@if(isset($results))

					<div class="row">
						<div class="col-12">
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Register Reading</h5>
									
								</div>
								<div class="card-body">
									<form class="row g-3">
										<div class="col-md-6">
											<label for="validationDefault01" class="form-label">Previouse Reading</label>
											<input type="number" class="form-control" id="validationDefault01" name="prev" value="{{$prev_reading}}" required>
										</div>
										<div class="col-md-6">
											<label for="validationDefault02" class="form-label">Current Reading</label>
											<input type="number" class="form-control" id="validationDefault02" name="newreading" placeholder="Current Reading" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefault02" class="form-label">ID No/Passport Number</label>
											<input type="text" class="form-control" id="validationDefault02" name="idno" value="{{$client_id_no}}" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefaultUsername" class="form-label">Metre No</label>
											<div class="input-group">
												<span class="input-group-text" id="inputGroupPrepend2">@</span>
												<input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" name="MetreNo" value="{{$mtr_no}}"
													required>
											</div>
										</div>

										<div class="col-md-4">
											<label for="validationDefault02" class="form-label">Reading Date</label>
											<input type="date" class="form-control" id="validationDefault02" name="readingdate" placeholder="Enter ID/Passport" required>
										</div>
										
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Register Client</button>
										</div>
									</form>
								</div>
							</div>

						
						</div>
					</div>

					@endif

					

				</div>
			</main>
@endsection