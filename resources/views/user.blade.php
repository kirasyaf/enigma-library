@extends('layouts.mainlayout')
@section('title', 'Users')

@section('content')

    <div>
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @if (Session::get('message'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
    @endif
    </div>

    <div class="mt-3 row d-flex justify-content-between">
        <div class="col-12 col-sm-5 mb-3">
            <form action="" method="get" class="">
                <div class="input-group">
                    <input type="text" class="form-control" id="floatingInputGroup1" name="keyword"
                        placeholder="Search Keyword">
                    <button class="input-group-text btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <div class="col-12 col-md-auto">
            <a href="/user-banned" class="btn btn-secondary me-4"><i class="bi bi-eye-fill me-2"></i>Banned User</a>
            <a href="/registered-users" class="btn btn-primary"><i class="bi bi-plus-lg"></i>New Registered User</a>
        </div>
    </div>

    <div class="my-5">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        @if ($item->phone)
                            {{ $item->phone }}
                        @else
                            -
                        @endif
                        <td>
                            <a href="/user-detail/{{ $item->slug }}"class="btn btn-primary"><i class="bi bi-eye"></i>Detail</a>
                            <a href="/user-ban/{{ $item->slug }}"class="btn btn-danger"><i class="bi bi-trash3"></i>Ban User</a>
                        </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection