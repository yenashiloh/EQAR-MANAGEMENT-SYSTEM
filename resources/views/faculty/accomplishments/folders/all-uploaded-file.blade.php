<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.faculty-header')

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
                    <a href="{{ route('faculty.accomplishments.add-accomplishment', ['program_folder_id' => $program_folder_id]) }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Add Accomplishment
                    </a>

                    @if (session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(function() {
                            var successAlert = document.getElementById('success-alert');
                            if (successAlert) {
                                successAlert.classList.remove('show');
                            }
                        }, 3000); // 3000 milliseconds = 3 seconds
                    });
                </script> --}}
                
                    {{-- <!-- Modal Add New Folder-->
                    <div class="modal fade" id="addFolderModal" tabindex="-1" role="dialog"
                        aria-labelledby="addFolderModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addFolderModalLabel">Add Program Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="folderName">Folder Name</label>
                                            <input type="text" class="form-control" id="folderName"
                                                name="folder_name" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Folder</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Edit Folder Modal -->
                    <div class="modal fade" id="programFolderModal" tabindex="-1" role="dialog"
                        aria-labelledby="programFolderModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="programFolderModalLabel">Edit Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editFolderForm" action="" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editFolderName">Folder Name</label>
                                            <input type="text" class="form-control" id="editFolderName"
                                                name="folder_name" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Department</th>
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
                                    <td>{{ $classList->courseTitle }}</td>
                                    <td>{{ $classList->assignedTask }}</td>
                                    <td>{{ $classList->dateFinished->format('F j, Y') }}</td>

                                    <td>{{ $classList->notes }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-secondary btn-sm me-2">View</a>
                                            <a href="{{ route('class-lists.edit', $classList->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                            <form action="{{ route('class-lists.destroy', $classList->id) }}" method="POST" class="mb-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.faculty-footer')

<script>
    function deleteFolder(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/accomplishments/view-folders/delete-program-folder/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your folder has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the folder.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
