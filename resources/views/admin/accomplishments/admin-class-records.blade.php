<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.admin-header')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="header-container">
                <h5 class="academic">
                    Class Records (an academic document that communicates information about a specific course and
                    explains the rules, responsibilities and expectations associated with it.)
                </h5>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="card mt-3">
                <div class="card-body">
                    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addFolderModal">
                        <i class="fas fa-plus"></i> Add New Folder
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
                                    <h5 class="modal-title" id="addFolderModalLabel">Add New Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.accomplishments.storeClassRecordSemestralFolder') }}"
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
                    <div class="modal fade" id="editFolderModal" tabindex="-1" role="dialog"
                        aria-labelledby="editFolderModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editFolderModalLabel">Edit Folder</h5>
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
                            @foreach ($folders as $folder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $folder->created_at->locale('en_PH')->format('F j, Y g:i A') }}</td>
                                    <td>{{ $folder->folder_name }}</td>
                                    <td>{{ $folder->admin->name ?? 'Unknown' }}</td>
                                    <td>
                                        <!-- View Button -->
                                        <a href="{{ route('admin.accomplishments.viewFolder', $folder->year_semestral_id) }}"
                                            class="btn btn-info btn-sm w-45 mb-1">View</a>
                                    
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-warning btn-sm w-45 mb-1" data-toggle="modal"
                                            data-target="#editFolderModal" data-id="{{ $folder->year_semestral_id }}"
                                            data-name="{{ $folder->folder_name }}">Edit</button>
                                    
                                        <!-- Delete Button -->
                                        <form id="delete-form-{{ $folder->year_semestral_id }}"
                                            action="{{ route('admin.accomplishments.deleteFolder', $folder->year_semestral_id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" id="is-deleted-{{ $folder->year_semestral_id }}" value="{{ $folder->is_deleted }}">
                                            <button type="button" class="btn btn-danger btn-sm w-45" onclick="confirmDelete({{ $folder->year_semestral_id }})">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin-footer')
