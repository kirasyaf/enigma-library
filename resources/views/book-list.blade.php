@extends('layouts.mainlayout')

@section('title', 'Book List')

@section('content')

<form action="" method="GET">
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="input-group mb-3">
            <input type="text" name="title" class="form-control" placeholder="Search book's title">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</div>
</form>

<div class="my-5">
    <div class="row">
        @foreach ($books as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="book-detail-list/{{ $item->slug }}" class="card-link">
                <div class="card h-100">
                    <img src="{{ $item->cover != null ? asset('/storage/cover/'.$item->cover) : asset('images/cover-not-found.png') }}" class="card-img-top" draggable="false" height="340px">
                    <div class="card-body">
                    <h5 class="card-title text-center">{{ $item->book_code }}</h5>
                    <p class="card-text text-center">{{ $item->title }}</p>
                    <p class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">
                        {{ $item->status }}
                    </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection