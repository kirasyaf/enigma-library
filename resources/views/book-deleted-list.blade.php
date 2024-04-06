@extends('layouts.mainLayout')

@section('title', 'List Deleted Book')

@section('content')

    <h1>List Deleted Book</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/books" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Back</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif

    <div class="my-5">
        <table class=" table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedBooks as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->book_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @foreach ($item->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td>{{ $item->status }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="book-restore/{{ $item->slug }}" class="btn btn-primary me-3"><i class="bi bi-arrow-clockwise"></i>Restore</a>
                            <form action="book-permanent-delete/{{ $item->slug }}" method="post" class="d-block mt-3"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="bi bi-trash me-2"></i>Delete Permanent</button>
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
        var result = confirm("Are you sure you want to permanently delete this book?");

        // Kembalikan nilai true atau false berdasarkan pilihan pengguna
        return result;
    }
</script>
