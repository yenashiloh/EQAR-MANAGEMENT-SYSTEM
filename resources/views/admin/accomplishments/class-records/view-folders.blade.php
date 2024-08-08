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
                <a href="{{ route('admin.accomplishments.class-records.admin-class-records') }}" class="btn btn-danger"><i
                        class="fas fa-arrow-left"></i> Back to previous page</a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="card mt-3">
                <div class="card-body">
                    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addFolderModal">
                        <i class="fas fa-plus"></i> Add Program Folder
                    </a>

                    @if (session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show text-center"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Modal Add New Folder-->
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
                                <form
                                    action="{{ route('admin.accomplishments.storeProgramFolder', ['id' => $year_semestral_id]) }}"
                                    method="POST">
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
                    </div>

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
                                <th>Date & Time</th>
                                <th>Folder Name</th>
                                <th>Uploaded By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programFolders as $index => $programFolder)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $programFolder->created_at->locale('en_PH')->format('F j, Y, g:i A') }}</td>
                                    <td>{{ $programFolder->folder_name }}</td>
                                    <td>{{ $programFolder->admin->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.accomplishments.class-records.all-uploaded-file', ['id' => $programFolder->program_folder_id]) }}" class="btn btn-info btn-sm">
                                            View Files
                                        </a>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#programFolderModal" data-id="{{ $programFolder->program_folder_id }}" data-name="{{ $programFolder->folder_name }}">Edit</button>

                                        <button class="btn btn-sm btn-danger" onclick="deleteFolder({{ $programFolder->program_folder_id }})">Delete</button>
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
