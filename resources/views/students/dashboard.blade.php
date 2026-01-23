<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student-dashboard.css') }}">
</head>
<body>

<div class="dashboard">

    
    <div class="header">
        <h2>🎓 Student Dashboard</h2>

        <div style="display:flex; gap:20px; align-items:center;">
            
            <div style="position:relative;">
                🔔
                @if(auth()->user()->unreadNotifications->count())
                    <span style="
                        position:absolute;
                        top:-8px;
                        right:-10px;
                        background:#ef4444;
                        color:white;
                        font-size:11px;
                        padding:2px 6px;
                        border-radius:50%;
                        font-weight:600;
                    ">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </div>

            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    
    <p class="welcome">
        Welcome, {{ auth()->user()->name }}
    </p>

    
    @if(session('error'))
        <div class="error-alert">
            {{ session('error') }}
        </div>
    @endif

    
    @if(session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    
    @if(auth()->user()->notifications->count())
        <div class="card notifications-card">
            <h3>🔔 Notifications</h3>

            <div class="notifications-scroll">
                @foreach(auth()->user()->notifications as $notification)
                    <div class="notification-item">
                        <strong>{{ $notification->data['title'] }}</strong><br>
                        {{ $notification->data['message'] }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    
    <div class="card">
        <h3>Available Courses</h3>

        <div class="course-list">
            @forelse($courses as $course)

                @php
                    $isEnrolled = auth()->user()
                        ->courses()
                        ->where('course_id', $course->id)
                        ->exists();

                    $teacherActive = $course->teacher && $course->teacher->status === 'active';
                @endphp

                <div class="course-item">

                    <div class="course-title">
                        {{ $course->title }}
                    </div>

                    <div class="course-teacher">
                        Teacher: {{ $course->teacher->name ?? 'N/A' }}
                    </div>

                    <div class="course-actions">

                        
                        @if($isEnrolled)
                            <span class="enrolled-badge">Enrolled</span>

                            <form method="POST"
                                  action="{{ route('courses.unenroll', $course->id) }}"
                                  class="inline-form">
                                @csrf
                                <button class="unenroll-btn"
                                        onclick="return confirm('Unenroll from this course?')">
                                    Unenroll
                                </button>
                            </form>

                        
                        @else

                            
                            @if($teacherActive)
                                <form method="POST"
                                      action="{{ route('courses.enroll', $course->id) }}"
                                      class="inline-form">
                                    @csrf
                                    <button class="enroll-btn-sm">
                                        Enroll
                                    </button>
                                </form>
                            @else
                                <button class="enroll-btn-sm"
                                        disabled
                                        style="background:#9ca3af; cursor:not-allowed;">
                                    Teacher not available
                                </button>
                            @endif

                            <a href="{{ route('courses.show', $course->id) }}"
                               class="view-btn">
                                View Course
                            </a>

                        @endif
                    </div>
                </div>

            @empty
                <p class="empty">No courses available</p>
            @endforelse
        </div>
    </div>

</div>

</body>
</html>
