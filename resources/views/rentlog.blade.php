@extends('layouts.mainlayout')
@section('title', 'Category')
@section('page-name', 'category')
    
@section('content')
    <h1 class="text-center">Rent Log List</h1>
    <div class="mt-5"x>
        <x-rent-log-table :rentlog='$rent_logs'/>
    </div>
@endsection