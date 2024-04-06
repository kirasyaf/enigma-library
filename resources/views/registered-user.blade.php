@extends('layouts.mainlayout')
@section('title', 'Users')

@section('content')

    <div class="d-flex justify-content-end">
        <a href="/users" class="btn btn-primary"><i class="bi bi-check-circle"></i>Approved User List</a>
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
            @foreach ($registeredUsers as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        @if ($item->phone)
                            {{ $item->phone }}
                        @else
                            -
                        @endif
                    </td>
                    <td><a href="/user-detail/{{ $item->slug }}" class="btn btn-success"><i class="bi bi-info-circle"></i> Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection