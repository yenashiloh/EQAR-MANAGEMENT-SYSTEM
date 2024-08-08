<!DOCTYPE html>
<html lang="en">

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
</head>

<body class="container-fluid bg-body-tertiary d-block" style="background-color: #f5f1f1;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                <div class="card-body p-5 text-center">
                    <h4>Verify</h4>
                    <p>Your code was sent to you via email</p>

                    @if ($errors->any())
                        <div class="text-center" id="errorMessage" style="color: red; font-size: 12px;">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verify-otp') }}" id="otpForm">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', session('email')) }}">

                        <div class="otp-field mb-4">
                            <input type="number" maxlength="1" required>
                            <input type="number" maxlength="1" required disabled>
                            <input type="number" maxlength="1" required disabled>
                            <input type="number" maxlength="1" required disabled>
                            <input type="number" maxlength="1" required disabled>
                            <input type="number" maxlength="1" required disabled>
                        </div>
                        <input type="hidden" name="otp" id="otpValue">

                        <button type="submit" class="btn btn-primary verify-button mb-3" disabled style=" background-color: #800000; ">
                            Verify
                        </button>
                    </form>

                    <p class="resend text-muted mb-0">
                        Didn't receive code?
                    <form id="resendForm" method="POST" action="{{ route('resend-otp') }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
                        <a href="#"
                            onclick="document.getElementById('resendForm').submit(); return false;">Request again</a>
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/verification-otp.js"></script>
    @include('partials.faculty-footer')
