<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enigma Library | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>

<style>
    a i{
        font-size: 19px;
        margin-left: 5px;
        margin-right: 12px;
    }

    
</style>

<body>

    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Enigma Library</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar"
                    aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="sidebar">
                    @if (Auth::user())
                        @if (Auth::user()->role_id == 1)
                            <a href="/dashboard" @if(request()->route()->uri =='dashboard') class='active'@endif><i class="bi bi-house-door"></i>Dashboard</a>                            
                            <a href="/" @if (request()->route()->uri == '/') class='active' @endif><i class="bi bi-journal-check"></i>Book List</a>
                            <a href="/books" @if(request()->route()->uri =='books' || request()->route()->uri =='book-add' || request()->route()->uri =='book-deleted' || request()->route()->uri =='book-edit/{slug}' || request()->route()->uri =='book-edit/{slug}' || request()->route()->uri =='book-delete/{slug}') class='active'@endif><i class="bi bi-book"></i>Books</a>
                            <a href="/categories" @if(request()->route()->uri =='categories' || request()->route()->uri =='category-add' || request()->route()->uri =='category-deleted' || request()->route()->uri =='category-edit/{slug}' || request()->route()->uri =='category-delete/{slug}') class='active'@endif><i class="bi bi-list-ul"></i>Categories</a>
                            <a href="/users" @if(request()->route()->uri =='users' || request()->route()->uri =='registered-users' || request()->route()->uri =='user-detail/{slug}' || request()->route()->uri =='user-ban/{slug}' || request()->route()->uri =='user-banned') class='active'@endif><i class="bi bi-people"></i>Users</a>
                            <a href="/rent-logs" @if(request()->route()->uri =='rent-logs') class='active'@endif><i class="bi bi-file-text"></i>Rent Log</a>                                                        
                            <a href="/book-rent" @if (request()->route()->uri == 'book-rent') class='active' @endif><i class="bi bi-arrow-return-right"></i>Book Rent</a>
                            <a href="book-return" @if (request()->route()->uri == 'book-return') class='active' @endif><i class="bi bi-arrow-return-left"></i>Book Return</a>
                            <a href="/logout"><i class="bi bi-box-arrow-left"></i>Logout</a>

                    @else
                        <a href="/profile" @if (request()->route()->uri == 'profile') class='active' @endif><i class="bi bi-person-circle"></i> Profile</a>                                           
                        <a href="/" @if (request()->route()->uri == '/') class='active' @endif><i class="bi bi-journal-check"></i>Book List</a>
                        <a href="/logout"><i class="bi bi-box-arrow-left"></i>Logout</a>
                        @endif
                    @else
                        <a href="/login"><i class="bi bi-box-arrow-in-right"></i>Login</a>
                    @endif
                </div>
                <div class="content p-5 col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>