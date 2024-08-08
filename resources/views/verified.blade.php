<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verification</title>
    <link rel="icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon"> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/role.css') }}">
    <link rel="stylesheet" href="../assets/css/verified-check.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awes+ome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" >
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href=" {{ asset('assets/fonts/feather.css') }}" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" >
    
    <style>
        .otp-field {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .otp-field input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 24px;
        }
        .next-button {
            background-color: #800000; 
            color: white;
            border: none; 
            padding: 10px 20px;
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
            width: 150px;
        }

        .next-button:hover {
            background-color: #440606; 
            border-color: #440606;
            color: #fff;
        }
    </style>
</head>

<body style="background-color:#f5f1f1;">
<div class="container">
    <div class="card">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 24 24">
            <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                <circle class="success-circle-outline" cx="12" cy="12" r="11.5" />
                <circle class="success-circle-fill" cx="12" cy="12" r="11.5" />
                <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13" />
            </g>
        </svg>
        <h3 class="text-center" style="margin-top: 25px; font-size: 30px;">Your email address is now verified!</h3>
        <p class="text-center" style="margin-top: 15px; font-size: 18px;">Click the Login button to continue</p>
        <div class="d-flex justify-content-center">
            <a href="/faculty-login" class="btn btn-primary next-button">Login</a>
        </div>
    </div>
</div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/verification-otp.js"></script>
    @include('partials.faculty-footer')
  
