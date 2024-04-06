@extends('layouts.mainlayout')

@section('title', 'Banned Users')

@section('content')

    <div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-end">
        <a href="/users" class="btn btn-primary"><i class="bi bi-arrow-left"></i>Back</a>
    </div>
    
    <div>
        <table class="table mt-3">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bannedUsers as $item)
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
                    <td>
                        <a href="/user-restore/{{ $item->slug }}" class="btn btn-primary me-3"><i class="bi bi-arrow-clockwise"></i>Restore</a>
                        <form action="user-permanent-ban/{{ $item->slug }}" method="post" class="d-inline-block"
                            onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="bi bi-trash me-2"></i>Ban Permanent</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<script>
    function confirmDelete() {
        // Tampilkan dialog konfirmasi
        var result = confirm("Are you sure you want to permanently delete this User?");

        // Kembalikan nilai true atau false berdasarkan pilihan pengguna
        return result;
    }
</script>