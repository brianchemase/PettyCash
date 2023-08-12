@extends('admins.inc.master')

@section('title', 'Dashboard')

@section('content')

    <main class="content">
        <div class="container-fluid p-0">
            permissions index


            <div class="row">
                @foreach ($permissions as $permission)
                    <article class="card-body m-2 outline-primary">{{ $permission->name }}</article>
                @endforeach
            </div>
        </div>
    </main>
@endsection
