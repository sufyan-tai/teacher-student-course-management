<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<div class="container">

    <h1>📊 Dashboard</h1>

    
    <div class="top-bar">
        <span>
            I am <b>{{ ucfirst(session('role')) }}</b> |
            Name: <b>{{ session('user_name') }}</b>
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

   
    @if(session('role') === 'student')
        <section>
            <h2>📚 Available Courses</h2>

            @if($courses->count() === 0)
                <p>No courses available.</p>
            @else
                <ul class="course-list">
                    @foreach($courses as $c)
                        <li>{{ $c->title }}</li>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif

    @if(session('role') === 'teacher')
        <section>
            <h2>📚 Course Module (Teacher)</h2>
            <form method="POST" action="{{ route('course.store') }}" class="course-form">
                @csrf

                <input type="text"
                       name="course_title"
                       placeholder="Enter Course Title"
                       class="@error('course_title') error-input @enderror">

                <button type="submit">Add Course</button>
            </form>

            @error('course_title')
                <div class="error-text">{{ $message }}</div>
            @enderror

            
            @if($courses->count() === 0)
                <p>No courses created yet.</p>
            @else
                <ul class="course-list">
                    @foreach($courses as $c)
                        <li>{{ $c->title }}</li>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif

</div>

</body>
</html>
