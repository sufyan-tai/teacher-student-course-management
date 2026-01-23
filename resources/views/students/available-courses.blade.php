<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Courses</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student-courses.css') }}">
</head>
<body>

<div class="container">

    <h1>📚 Available Courses</h1>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->teacher->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

     <a href="{{ route('student.dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>
