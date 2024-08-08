<!DOCTYPE html>
<html lang="en">
<title>Class Records</title>
@include('partials.faculty-header')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="header-container">
                <h5 class="academic">
                    Class Records (an academic document that communicates information about a specific course and
                    explains the rules, responsibilities and expectations associated with it.)
                </h5>
                <a href="{{ route('faculty.faculty-accomplishment') }}" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Back to previous page
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card mb-3" style="border: 1px solid #171617;">
                        <div class="card-body d-flex align-items-center justify-content-start" style="height: 60px;">
                            <h6 class="m-0">CLICK ME FOR REMINDERS AND INSTRUCTIONS</h6>
                        </div>
                    </div>

                    <a href="{{route ('faculty.accomplishments.faculty-add-accomplishment')}}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Add an accomplishment
                    </a>

                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Course Title</th>
                                <th>Assigned Task</th>
                                <th>Date</th>
                                <th>Where to Commit</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>Course 1</td>
                                <td>Task 1</td>
                                <td>2024-01-01</td>
                                <td>Link 1</td>
                                <td>Notes 1</td>
                                <td>Actions 1</td>
                            </tr>
                            <tr>
                                <td>Course 2</td>
                                <td>Task 2</td>
                                <td>2024-02-01</td>
                                <td>Link 2</td>
                                <td>Notes 2</td>
                                <td>Actions 2</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partials.faculty-footer')
