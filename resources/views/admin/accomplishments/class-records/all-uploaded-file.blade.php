<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.admin-header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="header-container">
                <h5 class="academic">
                    {{ $folderName }} (an academic document that communicates information about a specific course and
                    explains the rules, responsibilities, and expectations associated with it.)
                </h5>
                <a href="" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back to previous page</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="card mt-3">
                <div class="card-body">
                    @if (session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show text-center"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Department</th>
                                <th>Employee Name</th>
                                <th>Course Title</th>
                                <th>Assigned Task</th>
                                <th>Date</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classLists as $key => $classList)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $classList->department }}</td>
                                    <td>   @php
                                        $employee = $employeeDetails->get($classList->faculty_account_id);
                                        $employeeName = $employee ? $employee->first_name . ' ' . $employee->last_name : 'Unknown';
                                    @endphp
                                    {{ $employeeName }}</td>
                                    <td>{{ $classList->courseTitle }}</td>
                                    <td>{{ $classList->assignedTask }}</td>
                                    <td>{{ $classList->dateFinished->format('F j, Y') }}</td>
                                    <td>{{ $classList->notes }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-secondary btn-sm me-2">View</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.admin-footer')
