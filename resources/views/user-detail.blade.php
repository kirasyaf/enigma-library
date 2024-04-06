@extends('layouts.mainLayout')

@section('title', 'Detail User')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="/users" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i>Back</a>
        @if ($user->status == 'inactive')
            <a href="/user-approve/{{ $user->slug }}" class="btn btn-success"><i class="bi bi-check-circle"></i>Approve User</a>
        @endif
    </div>
   
    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class=w-50">
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" class="form-control bg-transparent" value="{{ $user->username }}" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" class="form-control bg-transparent" value="{{ $user->phone }}" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Addres</label>
                <textarea class="form-control bg-transparent" name="" id="" rows="5" readonly style="resize: none">{{ $user->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <input type="text" class="form-control bg-transparent" value="{{ $user->status }}" readonly>
            </div>
        </div>

        <div class="my-5 w-75 col-lg-9 col-md-6 text-center">
            <h3 class="mb-3"> User's Rent Logs</h3>
            <x-rent-log-table :rentlog='$rent_logs' />
        </div>
    </div>
@endsection