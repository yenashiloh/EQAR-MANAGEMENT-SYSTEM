<!DOCTYPE html>
<html lang="en">
<title>Accomplishments</title>
@include('partials.faculty-header')
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
                        @foreach ($folders as $folder)
                            @if ($folder->main_folder_name == 'Classroom Management')
                                <li>
                                    <a
                                        href="{{ route('faculty.accomplishments.folders.year-semestral', ['folder_name_id' => $folder->folder_name_id]) }}">
                                        {{ $folder->folder_name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="academic-list course">
                    <a href="#!" class="toggle-submenu" data-target="testAdminSubMenu">Test Administration
                        <i class="fas fa-chevron-down"></i> </a>
                    <ul class="sub-menu" id="testAdminSubMenu" style="display: none;">
                        @foreach ($folders as $folder)
                            @if ($folder->main_folder_name == 'Test Administration')
                                <li>
                                    <a
                                        href="{{ route('faculty.accomplishments.folders.year-semestral', ['folder_name_id' => $folder->folder_name_id]) }}">
                                        {{ $folder->folder_name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
@include('partials.faculty-footer')
