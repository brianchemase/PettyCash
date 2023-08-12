@extends('admins.inc.master')

@section('title', 'Dashboard')

@section('content')

    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>PettyCash</strong> Dashboard</h1>

            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Wallet Balance</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign align-middle">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <h1 class="mt-1 mb-3">KES 15325</h1>
                            <div class="mb-0">
                                <span class="text-muted">Current Wallet Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Active Staff</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-bag align-middle">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <h1 class="mt-1 mb-3"> 150</h1>
                            <div class="mb-0">
                                <span class="text-muted">Total active staff</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Amount Withdrawn</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-activity align-middle">
                                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">1400</h1>

                            <div class="mb-0">

                                <span class="text-muted">Total Amount Withdrawn</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Monthly Transaction</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-cart align-middle">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <h1 class="mt-1 mb-3">600</h1>
                            <div class="mb-0">

                                <span class="text-muted">Total monthly Amount Transacted</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Staff Past Threshold</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Staff Name</th>
                                    <th class="d-none d-xl-table-cell">Application Date</th>
                                    <th class="d-none d-xl-table-cell">Start Date</th>

                                    <th class="d-none d-xl-table-cell">Request Amount</th>
                                    <th class="d-none d-xl-table-cell">Monthly Allocation</th>
                                    <th>Wallet Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Project Apollo</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td class="d-none d-xl-table-cell">15,000</td>
                                    <td class="d-none d-xl-table-cell">15,000</td>
                                    <td>120</td>
                                    <td><span class="badge bg-success">Done</span></td>
                                    <td>
                                        <a href="#" class="btn btn-success"> <i class="align-middle"
                                                data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-primary"> <i class="align-middle"
                                                data-feather="printer"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Project Fireball</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td class="d-none d-xl-table-cell">15,000</td>
                                    <td class="d-none d-xl-table-cell">15,000</td>
                                    <td>120</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                    <td>
                                        <a href="#" class="btn btn-success"> <i class="align-middle"
                                                data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-primary"> <i class="align-middle"
                                                data-feather="printer"></i></a>

                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Project Nitro</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td class="d-none d-xl-table-cell">15,000</td>
                                    <td class="d-none d-xl-table-cell">15,000</td>
                                    <td>120</td>
                                    <td><span class="badge bg-warning">In progress</span></td>
                                    <td>
                                        <a href="#" class="btn btn-success"> <i class="align-middle"
                                                data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-primary"> <i class="align-middle"
                                                data-feather="printer"></i></a>

                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
