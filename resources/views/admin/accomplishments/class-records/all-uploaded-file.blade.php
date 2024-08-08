<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.admin-header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="header-container">
                <h5 class="academic">
                    Upload File (an academic document that communicates information about a specific course and
                    explains the rules, responsibilities, and expectations associated with it.)
                </h5>
                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Back to previous page
                </a>
            </div>
        </div>
    </div>

    <!-- View All Details Modal -->
    <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog"
    aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">View Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="viewDetailsContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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
                                <th>Date Submitted</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Course Title</th>
                                <th>Assigned Task</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classLists as $key => $classList)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $classList->created_at->format('F j, Y') }}</td>
                                    <td> @php
                                        $employee = $employeeDetails->get($classList->faculty_account_id);
                                        $employeeName = $employee
                                            ? $employee->first_name . ' ' . $employee->last_name
                                            : 'Unknown';
                                    @endphp
                                        {{ $employeeName }}</td>
                                    <td>{{ $classList->department }}</td>
                                    <td>{{ $classList->courseTitle }}</td>
                                    <td>{{ $classList->assignedTask }}</td>
                                    <td>
                                        @if ($classList->fileUpload)
                                            <a href="{{ Storage::url($classList->fileUpload) }}" target="_blank">
                                                {{ $classList->original_file_name ?? 'View File' }}
                                            </a>
                                        @else
                                            No file uploaded
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-info btn-sm"
                                            data-id="{{ $classList->id }}">View</a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-folder-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred. Please try again later.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    });

    //view details
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-info').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const classListId = this.dataset.id;

                fetch(`/class-records/${classListId}`)
                    .then(response => response.json())
                    .then(data => {
                        const dateCreated = new Date(data.created_at);
                        const dateFinished = new Date(data.dateFinished);
                        const formattedCreatedDate = new Intl.DateTimeFormat('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        }).format(dateCreated);

                        const formattedFinishedDate = new Intl.DateTimeFormat('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour12: true
                        }).format(dateFinished);

                        document.getElementById('viewDetailsContent').innerHTML = `
                       <div class="row">
                            <div class="col-md-6">
                              <p><strong>Date Created:</strong> ${formattedCreatedDate}</p>
                                <p><strong>Reported to:</strong> ${data.reporting_to}</p>
                                <p><strong>Course Title:</strong> ${data.courseTitle}</p>
                                <p><strong>Course Code:</strong> ${data.courseCode}</p>
                              ${data.notes ? `<p><strong>Notes:</strong> ${data.notes}</p>` : ''}
                            </div>
                            <div class="col-md-6">
                                <p><strong>Assigned Task:</strong> ${data.assignedTask}</p>
                                <p><strong>Department:</strong> ${data.department}</p>
                                <p><strong>Date Finished:</strong> ${formattedFinishedDate}</p>
                                <p><strong>File:</strong> ${data.fileUpload ? `<a href="${"/storage/" + data.fileUpload}" target="_blank">${data.originalFileName || 'View File'}</a>` : 'No file uploaded'}</p>
                               ${data.supportingDocuments ? `<p><strong>Description of Supporting Documents:</strong> ${data.supportingDocuments}</p>` : ''}
                            
                          
                            </div>
                        </div>
                    `;
                        $('#viewDetailsModal').modal('show');
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'An error occurred while fetching the details. Please try again later.',
                            'error'
                        );
                    });
            });
        });
    });
</script>
