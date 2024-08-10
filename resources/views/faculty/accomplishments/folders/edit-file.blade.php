<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Accomplishments</title>
    @include('partials.faculty-header')
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 col-lg-10 mx-auto">
                <div class="header-container">
                    <h5 class="academic">
                        Edit Accomplishment
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
                        <div class="d-flex justify-content-center">
                            <h6 class="m-0 mb-4">
                                <strong>Instructions:</strong>
                                Please update the necessary details. No abbreviations. All input with the symbol (<span style="color: red;">*</span>) are required.
                            </h6>
                        </div>
    
                        <form action="{{ route('faculty.accomplishments.folders.update-file', $accomplishment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h6>Reporting to:<span style="color: red;">*</span></h6>
                                        <div class="form-check">
                                            <input type="radio" name="reporting_to" id="admin" class="form-check-input" value="Admin" {{ $accomplishment->reporting_to == 'Admin' ? 'checked' : '' }} required>
                                            <label for="admin" class="form-check-label">Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="reporting_to" id="faculty" class="form-check-input" value="Faculty" {{ $accomplishment->reporting_to == 'Faculty' ? 'checked' : '' }} required>
                                            <label for="faculty" class="form-check-label">Faculty</label>
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="department" class="form-label">Department</label>
                                        <select class="form-select" id="department" name="department" aria-label="Department select" required>
                                            <option value="" disabled>Choose...</option>
                                            <option value="Electronics Engineering" {{ $accomplishment->department == 'Electronics Engineering' ? 'selected' : '' }}>Electronics Engineering</option>
                                            <option value="Mechanical Engineering" {{ $accomplishment->department == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                                            <option value="Applied Mathematics" {{ $accomplishment->department == 'Applied Mathematics' ? 'selected' : '' }}>Applied Mathematics</option>
                                            <option value="Information Technology" {{ $accomplishment->department == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                            <option value="Accountancy" {{ $accomplishment->department == 'Accountancy' ? 'selected' : '' }}>Accountancy</option>
                                            <option value="Entrepreneurship" {{ $accomplishment->department == 'Entrepreneurship' ? 'selected' : '' }}>Entrepreneurship</option>
                                            <option value="Business Administration Major in Human Resource Development Management, Marketing Management" {{ $accomplishment->department == 'Business Administration Major in Human Resource Development Management, Marketing Management' ? 'selected' : '' }}>Business Administration Major in Human Resource Development Management, Marketing Management</option>
                                            <option value="Secondary Education major in English, Mathematics" {{ $accomplishment->department == 'Secondary Education major in English, Mathematics' ? 'selected' : '' }}>Secondary Education major in English, Mathematics</option>
                                            <option value="Information Communication Technology" {{ $accomplishment->department == 'Information Communication Technology' ? 'selected' : '' }}>Information Communication Technology</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="collegeCampus" class="form-label">College/Campus</label>
                                        <input type="text" id="collegeCampus" class="form-control" name="collegeCampus" value="{{ $accomplishment->collegeCampus }}" readonly>
                                        <small class="form-text text-muted">This is auto-generated upon selecting a department</small>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="courseTitle" class="form-label">Course Title<span style="color: red;">*</span></label>
                                        <input type="text" id="courseTitle" name="courseTitle" class="form-control mt-0 mb-3" value="{{ $accomplishment->courseTitle }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="courseCode" class="form-label">Course Code<span style="color: red;">*</span></label>
                                        <input type="text" id="courseCode" name="courseCode" class="form-control mb-3" value="{{ $accomplishment->courseCode }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="assignedTask" class="form-label">Assigned Task<span style="color: red;">*</span></label>
                                        <select class="form-select mb-3" id="assignedTask" name="assignedTask" aria-label="Assigned task select" required>
                                            <option value="" disabled>Choose...</option>
                                            <option value="To develop" {{ $accomplishment->assignedTask == 'To develop' ? 'selected' : '' }}>To develop</option>
                                            <option value="To enhance" {{ $accomplishment->assignedTask == 'To enhance' ? 'selected' : '' }}>To enhance</option>
                                            <option value="To modify" {{ $accomplishment->assignedTask == 'To modify' ? 'selected' : '' }}>To modify</option>
                                            <option value="To improve" {{ $accomplishment->assignedTask == 'To improve' ? 'selected' : '' }}>To improve</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="dateFinished" class="form-label">Date Finished<span style="color: red;">*</span></label>
                                        <small class="form-text text-muted mb-1 mt-0">Any of the following: *Copy of the course syllabus in PDF form *Certification issued by the QAC/OTLD *Copy of the Curriculum Summary Matrix of OBE Syllabus</small>
                                        <input type="date" id="dateFinished" name="dateFinished" class="form-control mb-3" value="{{ $accomplishment->dateFinished->format('Y-m-d') }}" required>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="supportingDocuments" class="form-label">Description of Supporting Documents</label>
                                        <input type="text" id="supportingDocuments" name="supportingDocuments" class="form-control mb-3" value="{{ $accomplishment->supportingDocuments }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="fileUpload" class="form-label">Upload Supporting Document (max: 50MB)<span style="color: red;">*</span></label>
                                        <div class="dropzone" id="fileUploadDropzone">
                                            <input type="file" id="fileUpload" class="file-input" name="fileUpload" accept=".pdf,.doc,.docx,.xls,.xlsx" hidden>
                                            <div id="dropzoneContent">
                                                <i class="fas fa-cloud-upload-alt" style="font-size: 30px;"></i>
                                                <p>Drag and drop files here or click to upload an updated file</p>
                                               
                                            </div>
                                        </div>
                                        <p id="fileLinkContainer">
                                            @if ($accomplishment->fileUpload)
                                                <a href="{{ Storage::url($accomplishment->fileUpload) }}" target="_blank" class="file-link">View Current File</a>
                                            @else
                                                No file uploaded
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea id="notes" name="notes" class="form-control" rows="2">{{ $accomplishment->notes }}</textarea>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-secondary flex-grow-1 me-2" style="max-width: 150px; margin-right: 10px;">Cancel</button>
                                        <button type="submit" id="updateButton" class="btn btn-success flex-grow-1" style="max-width: 150px;">
                                            <span class="button-text">Update</span>
                                            <div class="progress-bar"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    @include('partials.faculty-footer')
    <script src="{{ asset('assets/js/edit-file.js') }}"></script>
    

