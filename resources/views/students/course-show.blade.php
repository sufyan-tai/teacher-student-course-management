<!DOCTYPE html>
<html>
<head>
    <title>Course Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student-dashboard.css') }}">
</head>

<body class="course-bg">

@php
    $images = [
        'Linux' => 'linux.jpg',
        'Cloud Computing' => 'cloud.jpg',
        'Cyber Security' => 'cyber.jpg',
        'React.js' => 'react.jpg',
        'mongo db' => 'mongo.jpg',
        '.Net' => 'net.jpg',
    ];

    $image = $images[$course->title] ?? 'cloud.jpg';
@endphp

<div class="course-wrapper">

    <div class="course-card">

            <img
            src="{{ asset('images/courses/'.$image) }}"
            alt="{{ $course->title }}"
            class="course-detail-img"
        >

        
        <h2 class="course-title">
            {{ $course->title }}
        </h2>

        
        <p class="course-teacher">
            👨‍🏫 {{ $course->teacher->name ?? 'N/A' }}
        </p>

        
        <p class="course-desc">
            {{ $course->description ?? 'No description available for this course.' }}
        </p>

        
        <a href="{{ route('student.dashboard') }}" class="back-link">
            ← Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>
