@extends('admins.inc.master')

@section('title', 'Dashboard')

@section('content')

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row text-center text-primary mb-3">
                <h1>Create Permission</h1>
            </div>
            <div class="row text-center">
                <div class="col-xs-12 col-md-5 mx-auto">
                    <form method="POST" action="/role_management/permissions" class="bg-light p-3 shadow"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="permission-name">Permission Name</span>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Enter permission name" aria-label="permission-name"
                                aria-describedby="permission-name">
                        </div>
                        @error('name')
                            <p class="text-danger fs-6">
                                {{ $message }}
                            </p>
                        @enderror

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
