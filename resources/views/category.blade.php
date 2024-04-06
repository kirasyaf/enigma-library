@extends('layouts.mainlayout')
@section('title', 'Category')
    
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
            <a href="category-deleted" class="btn btn-secondary me-4 "><i class="bi bi-eye-fill me-2"></i>View Deleted Data</a>
            <a href="category-add" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add Data</a>
        </div>
    </div>
    
    <div class="my-5"></div>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="category-edit/{{$item->slug}}" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i>Edit</a>
                            <a href="category-delete/{{$item->slug}}" class="btn btn-danger"><i class="bi bi-trash3"></i>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection