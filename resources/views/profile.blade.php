@extends('layouts.mainlayout')
@section('title', 'Profile')
    
@section('content')

<div class="w-100 col-lg-9 col-md-6">
    <h3 class="mb-3"> Your Rent Logs</h3>
    <x-rent-log-table :rentlog='$rent_logs' />
</div>

@endsection