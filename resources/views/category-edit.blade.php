@extends('layouts.mainlayout')
@section('title', 'Edit Category')
    
@section('content')
    <h1>Edit Category</h1>

    <div class="mt-5 w-50">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/category-edit/{{$category->slug}}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}" placeholder="Category Name">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success mt-4"><i class="bi bi-arrow-repeat me-2"></i>Update</button>
            </div>
        </form>
    </div>
@endsection