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
                    Add Accomplishments (an academic document that communicates information about a specific course and
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
                    <div class="d-flex justify-content-center">
                        <h6 class="m-0 mb-4">
                            <strong>Instructions:</strong>
                            Please fill in the necessary details. No abbreviations. All input with the symbol (<span style="color: red;">*</span>) are required.
                        </h6>
                    </div>
                    
                    <form action="{{ route('faculty.accomplishments.folders.store-class-list', $program_folder_id) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                
                        <div class="container">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h6>Reporting to:<span style="color: red;">*</span></h6>
                                    <div class="form-check">
                                        <input type="radio" name="reporting_to" id="admin" class="form-check-input" value="Admin" required>
                                        <label for="admin" class="form-check-label">Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="reporting_to" id="faculty" class="form-check-input" value="Faculty" checked required>
                                        <label for="faculty" class="form-check-label">Faculty</label>
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department" aria-label="Department select" required>
                                        <option value="" disabled selected>Choose...</option>
                                        <option value="Electronics Engineering">Electronics Engineering</option>
                                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                                        <option value="Applied Mathematics">Applied Mathematics</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Accountancy">Accountancy</option>
                                        <option value="Entrepreneurship">Entrepreneurship</option>
                                        <option value="Business Administration Major in Human Resource Development Management, Marketing Management">Business Administration Major in Human Resource Development Management, Marketing Management</option>
                                        <option value="Secondary Education major in English, Mathematics">Secondary Education major in English, Mathematics</option>
                                        <option value="Information Communication Technology">Information Communication Technology</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="collegeCampus" class="form-label">College/Campus</label>
                                    <input type="text" id="collegeCampus" class="form-control" name="collegeCampus" readonly>
                                    <small class="form-text text-muted">This is auto-generated upon selecting a department</small>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="courseTitle" class="form-label">Course Title<span style="color: red;">*</span></label>
                                    <input type="text" id="courseTitle" name="courseTitle" class="form-control mt-0 mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="courseCode" class="form-label">Course Code<span style="color: red;">*</span></label>
                                    <input type="text" id="courseCode" name="courseCode" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="assignedTask" class="form-label">Assigned Task<span style="color: red;">*</span></label>
                                    <select class="form-select mb-2" id="assignedTask" name="assignedTask" aria-label="Assigned task select" required>
                                        <option value="" disabled selected>Choose...</option>
                                        <option value="To develop">To develop</option>
                                        <option value="To enhance">To enhance</option>
                                        <option value="To revise">To revise</option>
                                        <option value="To review">To review</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="dateFinished" class="form-label">Date You Finished the Assigned Task<span style="color: red;">*</span></label>
                                    <input type="date" id="dateFinished" name="dateFinished" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="supportingDocuments" class="form-label mb-0">Description of Supporting Documents</label>
                                    <small class="form-text text-muted mb-1">Any of the following: *Copy of the course syllabus in PDF form *Certification issued by the QAC/OTLD *Copy of the Curriculum Summary Matrix of OBE Syllabus</small>
                                    <input type="text" id="supportingDocuments" name="supportingDocuments" class="form-control mb-2">
                                </div>
                                <div class="col-md-12">
                                    <label for="fileUpload" class="form-label">Upload Supporting Document (max: 50MB)</label>
                                    <div class="dropzone" id="fileUploadDropzone">
                                        <input type="file" id="fileUpload" class="file-input" name="fileUpload" hidden>
                                        <div id="dropzoneContent">
                                            <i class="fas fa-cloud-upload-alt" style="font-size: 30p    x;"></i>
                                            <p>Drag and drop files here or click to upload</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="notes" class="form-label mt-2">Notes</label>
                                    <input type="text" id="notes" name="notes" class="form-control mb-4" placeholder="Add your notes here.">
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary flex-grow-1 me-2" style="max-width: 150px; margin-right: 10px;">Cancel</button>
                                        <button type="submit" id="saveButton" class="btn btn-success flex-grow-1" style="max-width: 150px;">
                                            <span class="button-text">Save</span>
                                            <div class="progress-bar"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    @include('partials.faculty-footer')
    <script src="{{ asset('assets/js/forms.js') }}"></script>
    

