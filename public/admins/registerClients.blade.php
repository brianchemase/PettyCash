@extends('account.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Clients Registration </h1>

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


					<div class="row">
						<div class="col-12">
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Register Clients</h5>
									
								</div>
								<div class="card-body">
									<form class="row g-3">
										<div class="col-md-4">
											<label for="validationDefault01" class="form-label">Full name</label>
											<input type="text" class="form-control" id="validationDefault01" name="fullnames" placeholder="Enter Full Names" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefault02" class="form-label">Phone</label>
											<input type="text" class="form-control" id="validationDefault02" name="phoneno" placeholder="phone (0712123123)" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefault02" class="form-label">ID No/Passport Number</label>
											<input type="text" class="form-control" id="validationDefault02" name="idno" placeholder="Enter ID/Passport" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefaultUsername" class="form-label">Metre No</label>
											<div class="input-group">
												<span class="input-group-text" id="inputGroupPrepend2">@</span>
												<input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" name="MetreNo" placeholder="Entre Metre No"
													required>
											</div>
										</div>
										
										<div class="col-md-4">
											<label for="validationDefault04" class="form-label">Area</label>
											<select class="form-select" id="validationDefault04" required>
												<option selected disabled value="">Choose...</option>
												<option> Area 1...</option>
												<option> Area 2...</option>
											</select>
										</div>
										<div class="col-md-4">
											<label for="validationDefault04" class="form-label">Gender</label>
											<select class="form-select" id="validationDefault04" required>
												<option selected disabled value="">Choose...</option>
												<option> Male</option>
												<option> Female</option>
											</select>
										</div>
										
										
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Register Client</button>
										</div>
									</form>
								</div>
							</div>

						
						</div>
					</div>

					

				</div>
			</main>
@endsection