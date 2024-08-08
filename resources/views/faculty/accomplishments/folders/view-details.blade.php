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
                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Back to previous page
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="card mt-3">
                <div class="card-body">
                    <a href="{{ route('faculty.accomplishments.add-accomplishment', ['program_folder_id' => $program_folder_id]) }}"
                        class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Add Accomplishment
                    </a>

                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Department</th>
                                <th>Course Title</th>
                                <th>Assigned Task</th>
                                <th>Date</th>
                                <th>File</th>
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
                                    <td>
                                        @if($classList->fileUpload)
                                            <a href="{{ Storage::url($classList->fileUpload) }}" target="_blank">
                                                {{ $classList->original_file_name ?? 'View File' }}
                                            </a>
                                        @else
                                            No file uploaded
                                        @endif
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

@include('partials.faculty-footer')
