@extends('layouts.mainLayout')

@section('title', 'Book Detail')

@section('content')
<h1 class="text-center">Detail Book</h1>

    <div class="my-5 w-100">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">{{ $book->title }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        @if ($book->cover != '')
                            <img src="{{ asset('storage/cover/' . $book->cover) }}" alt="Cover Image"
                                class="img-fluid mb-3 d-block" width="200px">
                        @else
                            <img src="{{ asset('images/cover-not-found.jpg') }}" alt="Cover Image" class="img-fluid mb-3 d-block"
                                width="200px">
                        @endif
                    </div>
                    <div class="col-lg-9 col-md-6">
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">Code</label>
                            <p>{{ $book->book_code }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">Category</label>
                            <p>
                                @foreach ($book->categories as $category)
                                    {{ $category->name }} 
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection