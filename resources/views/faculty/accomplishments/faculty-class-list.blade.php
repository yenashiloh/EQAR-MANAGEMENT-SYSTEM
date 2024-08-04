<!DOCTYPE html>
<html lang="en">
<title>Class Records</title>
@include('partials.faculty-header')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-lg-10 mx-auto">
            <div class="header-container">
                <h5 class="academic">
                    Class List (an academic document that communicates information about a specific course and
                    explains the rules, responsibilities and expectations associated with it.)
                </h5>
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

                    <a href="{{ route('faculty.accomplishments.faculty-add-class-list') }}"
                        class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Add an accomplishment
                    </a>
                    @php
                    $successMessage = request()->query('success');
                @endphp
                
                @if ($successMessage)
                    <div id="successMessage" class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ $successMessage }}
                    </div>
                @endif
                
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
                        @foreach ($classLists as $key => $classList)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $classList->courseTitle }}</td>
                                <td>{{ $classList->assignedTask }}</td>
                                <td>{{ $classList->dateFinished->format('F j, Y') }}</td>
                                <td></td>
                                <td>{{ $classList->notes }}</td>
                                <td>
                                    <!-- Replace with actual routes -->
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
                </div>
            </div>
        </div>
    </div>
    @include('partials.faculty-footer')
    