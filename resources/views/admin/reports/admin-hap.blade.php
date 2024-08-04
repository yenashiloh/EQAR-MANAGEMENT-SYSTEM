<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.admin-header')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-lg-11 mx-auto">
            <div class="header-container">
                <h5 class="academic">
                    Department/Section-level Consolidated QAR - TG
                </h5>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-11 mx-auto">
            <div class="alert alert-primary" role="alert">
                <h6 style="color: #171617;"><strong>Reminders:</strong></h6>
                <li style="color: rgb(87, 87, 87)">Only the "Accepted" accomplishments will be included in
                    consolidated Excel File.</li>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-2 no-margin-right">
                                <label for="from1" class="form-label">From*</label>
                                <input type="number" id="from1" class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end no-margin-right">
                                <input type="number" id="from2" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="to1" class="form-label">To*</label>
                                <input type="number" id="to1" class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <input type="number" id="to2" class="form-control">
                            </div>
                        </div>

                        <hr>
                        <h6 class="mb-3">Records for QR of Y 2024</h6>

                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Inclusive Date</th>
                                    <th>Accomplishment</th>
                                    <th>QAR Type</th>
                                    <th>Employee</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Flug Raising Ceremony April 1, 2024</td>
                                    <td>April 1, 2024 April - 1, 2024</td>
                                    <td>Attendance in University and College Functions</td>
                                    <td>ACADEMIC</td>
                                    <td>NABAYRA, JAMES V.</td>
                                    <td>07-02-2024</td>
                                    <td>
                                        <h6 class="hap-title">HAP</h6>
                                        <span class="hap-date">2024-07-12 09:20am</span>
                                        <h6 class="dean-title">DEAN/DIRECTOR</h6>
                                        <span class="dean-date">2024-07-12 09:20am</span>
                                        <h6 class="review-title">FOR REVIEW OF SECTOR HEAD</h6>
                                    </td>
                                    <td><button class="btn btn-primary">Pending Review</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Flug Raising Ceremony April 1, 2024</td>
                                    <td>April 1, 2024 April - 1, 2024</td>
                                    <td>Attendance in University and College Functions</td>
                                    <td>ACADEMIC</td>
                                    <td>NABAYRA, JAMES V.</td>
                                    <td>07-02-2024</td>
                                    <td>
                                        <h6 class="hap-title">HAP</h6>
                                        <span class="hap-date">2024-07-12 09:20am</span>
                                        <h6 class="dean-title">DEAN/DIRECTOR</h6>
                                        <span class="dean-date">2024-07-12 09:20am</span>
                                        <h6 class="review-title">FOR REVIEW OF SECTOR HEAD</h6>
                                    </td>
                                    <td><button class="btn btn-primary">Pending Review</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>


        @include('partials.admin-footer')
