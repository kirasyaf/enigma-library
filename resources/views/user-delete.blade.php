@extends('layouts.mainLayout')

@section('title', 'Delete User')

@section('content')

    <form action="/user-delete/{{ $user->slug }}" method="POST"class="mx-auto card shadow col-6 d-flex justify-content-center align-items-center">
        @csrf
        @method('DELETE')
        <h3 class="card-title m-5 text-center">
            Are you sure to delete user <b>{{ $user->username }}</b>?</h3>

        <div class="card-body mb-5">
            <a href="/user-destroy/{{$user->slug}}" class="btn btn-danger me-3"><i class="bi bi-trash"></i>Delete</a>
            <a href="/users"class="btn btn-primary"><i class="bi bi-x-circle"></i>Cancel</a>
        </div>
    </form>

@endsection