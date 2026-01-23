<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="dashboard">

    <div class="header">
        <h2>👨‍🏫 Teacher Dashboard</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    <p>Welcome, {{ auth()->user()->name }}</p>

    {{-- NOTIFICATIONS --}}
    <div class="card notifications-card">
        <h3>🔔 Notifications</h3>

        @if(auth()->user()->notifications->count())
            <div class="notifications-scroll">
                @foreach(auth()->user()->notifications as $notification)
                    <div class="notification-item">
                        <strong>{{ $notification->data['title'] }}</strong><br>
                        {{ $notification->data['message'] }}
                    </div>
                @endforeach
            </div>
        @else
            <p style="color:#a0aec0;">No notifications yet</p>
        @endif
    </div>

    <div class="grid">

        {{-- ADD COURSE --}}
        <div class="card">
            <h3>Add Course</h3>
            <form method="POST" action="{{ route('teacher.courses.store') }}">
                @csrf
                <input type="text" name="title" placeholder="Course title" required>
                <button class="add-btn">Add</button>
            </form>
        </div>

        {{-- YOUR COURSES --}}
        <div class="card">
            <h3>Your Courses</h3>

            <ul class="course-list">
                @forelse($courses as $course)
                   <li class="course-item">
    <span class="course-title">{{ $course->title }}</span>

    <div class="course-actions">
        <a href="{{ route('teacher.courses.students', $course->id) }}"
           class="view-btn">
            View Students
        </a>

        <form method="POST"
              action="{{ route('teacher.courses.delete', $course->id) }}"
              class="delete-form">
            @csrf
            @method('DELETE')

            <button class="icon-btn"
                    onclick="return confirm('Delete this course?')">
                🗑️
            </button>
        </form>
    </div>
</li>

                @empty
                    <li class="empty">No courses added yet</li>
                @endforelse
            </ul>
        </div>

    </div>

</div>

</body>
</html>
