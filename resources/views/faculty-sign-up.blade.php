<!DOCTYPE html>
<html lang="en">
<title>Sign  Up</title>
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
    
    <style>
         .next-button {
        background-color: #800000; 
        border-color: #800000; 
        color: #fff;
    }

    .next-button:hover {
        background-color: #440606; 
        border-color: #440606;
        color: #fff;
    }
    </style>
    
</head>

<body>
    <<div class="d-flex justify-content-center align-items-center vh-100">
        <div class="bg-image">
            <img class="bg-image" src="assets/images/PUP_1.jpeg" alt="">
        </div>
        <div class="overlay"></div>
        <div class="card text-center mx-auto p-4">
            <img class="logo-sign-in mb-4 mt-2" src="../assets/images/pup-logo.png" alt="PUP Logo">
            <h3 class="text-role mb-3" id="step-header">Step 1: Create Account</h3>
            <div class="">
                <form id="multi-step-form" action="{{ route('faculty-sign-up.post') }}" method="POST" id="myForm">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Step 1: Create Account -->
                    <div class="step active">
                        <div class="row mb-3">
                            
                            <div class="col-md-6 d-flex flex-column">
                                <label for="email" class="form-label mt-4">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your Email Address" required>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <label for="password" class="form-label mt-4">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your Password" required>
                                <span id="password-error" class="error-message text-danger mt-2"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm your Password" required>
                                <div id="confirm-password-error" class="error-message text-danger mt-2"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-1">
                            <button type="button" class="btn btn-primary next-step btn-custom-width next-button"
                                style="margin-top: 40px;">Next</button>
                        </div>
                    </div>

                    <!-- Step 2: Personal Details -->
                    <div class="step">
                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="firstName" class="form-label mt-4">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name"
                                    placeholder="Enter your First Name" required>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <label for="middleName" class="form-label mt-4">Middle Name (optional)</label>
                                <input type="text" class="form-control" id="middleName" name="middle_name"
                                    placeholder="Enter your Middle Name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name"
                                    placeholder="Enter your Last Name" required>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <label for="birthday" class="form-label">Birthdate</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                                <span id="birthdate-error" class="error-message text-danger mt-2"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone-number" name="phone_number"
                                    placeholder="Enter your Phone Number" required>
                                <span id="phone-number-error" class="error-message text-danger mt-2"></span>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <label for="sex" class="form-label">Gender</label>
                                <select class="form-select" id="sex" name="sex" required>
                                    <option value="" disabled selected>Select your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button"
                                class="btn btn-secondary prev-step btn-custom-width me-4" style="margin-right: 10px;">Previous</button>
                            <button type="button" class="btn btn-primary next-step btn-custom-width next-button next-button">Next</button>
                        </div>
                    </div>

                    <!-- Step 3: Additional Details -->
                    <div class="step">
                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department"
                                    placeholder="Enter your Department" required>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <label for="idNumber" class="form-label">ID Number</label>
                                <input type="number" class="form-control" id="idNumber" name="id_number"
                                    placeholder="Enter your ID Number" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="employeeType" class="form-label">Employee Type</label>
                                <select class="form-select" id="employeeType" name="employee_type" required>
                                    <option value="" disabled selected>Select employee type</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Regular">Regular</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <div class="d-flex justify-content-center mt-2">
                                <button type="button"
                                    class="btn btn-secondary prev-step btn-custom-width me-4" style="margin-right: 10px;">Previous</button>
                                <button type="submit" class="btn btn-primary btn-custom-width next-button">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@include('partials.faculty-footer')