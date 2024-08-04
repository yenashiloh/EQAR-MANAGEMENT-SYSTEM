<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.admin-header')
<div class="container mt-5">
    <h4 class="academic font-weight-bold">ACADEMIC PROGRAM DEVELOPMENT</h4>
    <div class="row">
        <div class="col-md-12">
            <ul>
                <li class="academic-list course"><a href="/course-syllabus">Course Syllabus</a></li>
                <li class="academic-list course"><a href="/instructional-material">Instructional Material</a></li>
                <li class="academic-list course">
                    <a href="#!" class="toggle-submenu" data-target="classroomSubMenu">Classroom Management <i
                            class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="sub-menu" id="classroomSubMenu" style="display: none;">
                        <li><a href="{{ route('admin.accomplishments.admin-class-records') }}">Class Record</a></li>
                        <li><a href="/classroom-management/classlist">Classlist</a></li>
                        <li><a href="/classroom-management/grade-sheets">Exams, Activities, Projects, Case Study, etc.</a></li>
                        <li><a href="/classroom-management/class-record">Grade Sheets</a></li>
                        <li><a href="/classroom-management/grade-sheets">Monitoring of Classroom</a></li>
                        <li><a href="/classroom-management/grade-sheets">Teaching Assignment</a></li>
                    </ul>
                </li>
                <li class="academic-list course">
                    <a href="#!" class="toggle-submenu" data-target="testAdminSubMenu">Test Administration <i
                            class="fas fa-chevron-down"></i> </a>
                    <ul class="sub-menu" id="testAdminSubMenu" style="display: none;">
                        <li><a href="/test-administration/exam-schedule">Checked Exam</a></li>
                        <li><a href="/test-administration/exam-results">Class Record</a></li>
                        <li><a href="/test-administration/analysis">Copy of Exam with Key & Table of Specification</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>



@include('partials.admin-footer')
