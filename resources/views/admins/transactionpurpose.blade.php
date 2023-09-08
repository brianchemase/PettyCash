@extends('admins.inc.master')

@section('title', 'Dashboard')

@section('content')

    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Transaction Purpose Tab</h1>

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

            <!-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Empty card</h5>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div> -->


            <div class="row">
                <div class="col-4">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Register Transaction Purpose</h5>
                            
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('savetransactionpurpose') }}" method="POST">
                            @csrf
                                <div class="col-md-12">
                                    <label for="validationDefault01" class="form-label">Purpose Description</label>
                                    <input type="text" class="form-control" id="validationDefault01" name="purpose" placeholder="Enter Purpose" required>
                                </div>
                                
                                
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-8">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Registered Transaction Purpose</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Purpose Description</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($transactionPurposes as $purpose)
                                        <tr>
                                            <td>{{ $purpose->id }}</td>
                                            <td>{{ $purpose->purpose }}</td>
                                            <td>
                                                @if($purpose->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Disabled</span>
                                                @endif</td>
                                            <td> </td>
                                        </tr>
                                    @endforeach
									</tbody>
								</table>
							</div>
						</div>
                </div>
            </div>

        </div>
    </main>
@endsection
