
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon"> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<style>
.custom-dropdown-button {
    background-color: #171617;
    color: #ffffff; 
    border: 1px solid #171617; 
}

.custom-dropdown-button:focus, .custom-dropdown-button:hover {
    background-color:  #171617; 
    color: #ffffff; 
    border: 1px solid #171617; 
}

.custom-dropdown-button:active {
    background-color: #171617;
}

.custom-dropdown-button:focus {
    background-color: #171617 !important;
}

.dropdown-item {
    color: #ffffff; 
}

.dropdown-item:hover {
    background-color: #333; 
    color: #bebebe; 
}

.dropdown-menu .logout-link:hover, .dropdown-menu .logout-link:focus {
    background-color:  #f0eded;
    color: #131313; 
}

</style>

<body style="background-color: #FEF9FF;">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/pup-logo.png') }}" width="50" height="50" alt="Logo">
            <span class="brand-text">PUP Farm</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('accomplishments*') || Request::is('faculty/accomplishments/folders*') || Request::routeIs('faculty.faculty-accomplishment') ? 'active' : '' }}" href="{{ route('faculty.faculty-accomplishment') }}">Accomplishments</a>
                </li>
                <li class="nav-item reports-item">
                    <a class="nav-link {{ Request::is('reports*') ? 'active' : '' }}" href="#" id="reportsLink">Reports</a>
                    <div class="reports-submenu-custom" id="reportsSubmenu">
                        <div class="submenu-content">
                            <h5 class="submenu-item" style="color: #F7D328; margin-top: 15px; font-size: 18px;">CONSOLIDATED QAR</h5>
                            <a class="submenu-item" href="#">My accomplishments</a>
                            <a class="submenu-item" href="{{route ('admin.reports.admin-hap')}}" style="margin-bottom: 15px;">HAP - TG</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="ml-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle custom-dropdown-button mr-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ $facultyDetails['first_name'] ?? '' }} {{ $facultyDetails['last_name'] ?? '' }}
                    </button>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>