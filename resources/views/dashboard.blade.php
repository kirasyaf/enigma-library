@extends('layouts.mainlayout')
@section('title', 'Dashboard')

@section('content')

<h1>Welcome, {{ Auth::user()->username }}</h1>
<div class="row mt-5">
    <div class="col-lg-4">
        <a href="/books" class="no-decoration">
            <div class="card-data book">
                <div class="row">
                    <div class="col-6 d-flex justify-content-center"><i class="bi bi-book"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card-desc">Books</div>
                        <div class="card-count">{{ $book_count }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4">
        <a href="/categories" class="no-decoration">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6 d-flex justify-content-center"><i class="bi bi-list-task"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card-desc">Categories</div>
                        <div class="card-count">{{ $category_count }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4">
        <a href="/users" class="no-decoration">
            <div class="card-data user">
                <div class="row">
                    <div class="col-6 d-flex justify-content-center"><i class="bi bi-people"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card-desc">Users</div>
                        <div class="card-count">{{ $user_count }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
     {{-- Rent Log --}}
     <div class="my-5">
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>

    <div class="my-5">
        {{ $rent_logs->withQueryString()->links() }}
    </div>
</div>

</div>
@endsection