<!DOCTYPE html>
<html lang="en">
<title>Role</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/role.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awes+ome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
</head>

<body>
    <div class="bg-container d-flex justify-content-center align-items-center vh-100">
        <div class="bg-image">
            <img class="bg-image" src="assets/images/PUP_1.jpeg" alt="">
        </div>
        <div class="overlay"></div>
        <div class="card-role text-center mx-auto">
            <img class="logo-role mb-4" src="../assets/images/pup-logo.png" alt="PUP Logo">
            <h2 class="text-role mb-4">WELCOME TO PUP-T FARM SYSTEM</h2>
            <div class="btn-container d-flex justify-content-center">
                <a href="{{route ('faculty-login')}}" class="btn btn-primary mx-2 fs-4">Faculty</a>
                <a href="{{route ('admin-login')}}" class="btn btn-danger mx-2 fs-4">Admin</a>
            </div>
        </div>
    </div>
@include('partials.faculty-footer')