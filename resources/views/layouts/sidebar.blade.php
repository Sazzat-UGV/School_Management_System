<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets') }}/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ config('app.name') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (Auth::user()->user_type == 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Admins</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.index') }}"><i class='bx bx-radio-circle'></i>Admin List</a>
                    </li>
                    <li> <a href="{{ route('admin.create') }}"><i class='bx bx-radio-circle'></i>Add Admin</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Teachers</div>
                </a>
                <ul>
                    <li> <a href="{{ route('teacher.index') }}"><i class='bx bx-radio-circle'></i>Teacher List</a>
                    </li>
                    <li> <a href="{{ route('teacher.create') }}"><i class='bx bx-radio-circle'></i>Add Teacher</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Students</div>
                </a>
                <ul>
                    <li> <a href="{{ route('student.index') }}"><i class='bx bx-radio-circle'></i>Student List</a>
                    </li>
                    <li> <a href="{{ route('student.create') }}"><i class='bx bx-radio-circle'></i>Add Student</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-user-circle'></i>
                    </div>
                    <div class="menu-title">Parents</div>
                </a>
                <ul>
                    <li> <a href="{{ route('parent.index') }}"><i class='bx bx-radio-circle'></i>Parent List</a>
                    </li>
                    <li> <a href="{{ route('parent.create') }}"><i class='bx bx-radio-circle'></i>Add Parent</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-chalkboard'></i>
                    </div>
                    <div class="menu-title">Classes</div>
                </a>
                <ul>
                    <li> <a href="{{ route('class.index') }}"><i class='bx bx-radio-circle'></i>Class List</a>
                    </li>
                    <li> <a href="{{ route('class.create') }}"><i class='bx bx-radio-circle'></i>Add Class</a>
                    </li>
                </ul>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-book'></i>
                    </div>
                    <div class="menu-title">Subjects</div>
                </a>
                <ul>
                    <li> <a href="{{ route('subject.index') }}"><i class='bx bx-radio-circle'></i>Subject List</a>
                    </li>
                    <li> <a href="{{ route('subject.create') }}"><i class='bx bx-radio-circle'></i>Add Subject</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-book-add'></i>
                    </div>
                    <div class="menu-title">Assign Subject</div>
                </a>
                <ul>
                    <li> <a href="{{ route('assign.index') }}"><i class='bx bx-radio-circle'></i>Assign List</a>
                    </li>
                    <li> <a href="{{ route('assign.create') }}"><i class='bx bx-radio-circle'></i>Assign New </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->user_type == 'teacher')
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->user_type == 'student')
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->user_type == 'parent')
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
