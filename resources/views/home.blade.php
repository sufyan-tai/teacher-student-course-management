<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student-Teacher Course Platform</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>


<nav class="navbar">
    <div class="logo">📘 EduConnect</div>

    <div class="nav-links">
        <a href="{{ route('login') }}" class="btn-outline">Login</a>
        <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
    </div>
</nav>


<section class="hero">
    <div class="hero-content">
        <h1>
            Learn. Teach. <br>
            <span>Grow Together.</span>
        </h1>

        <p>
            A modern platform where teachers create courses  
            and students enroll, learn, and grow — all in one place.
        </p>

       <div class="hero-buttons">
    <a href="{{ route('register') }}?role=student" class="btn-primary">
        Join as Student
    </a>

    <a href="{{ route('register') }}?role=teacher" class="btn-secondary">
        Join as Teacher
    </a>
</div>

    </div>
</section>


<section class="features">
    <div class="feature-card">
        <h3>👨‍🏫 Teacher Dashboard</h3>
        <p>
            Create courses, manage students,  
            and get instant enrollment notifications.
        </p>
    </div>

    <div class="feature-card">
        <h3>👨‍🎓 Student Learning</h3>
        <p>
            Browse courses, enroll easily,  
            and learn from skilled teachers.
        </p>
    </div>

    <div class="feature-card">
        <h3>🔔 Smart Notifications</h3>
        <p>
            Real-time alerts for enrollments  
            and course updates.
        </p>
    </div>
</section>


<footer class="footer">
    <p>© {{ date('Y') }} EduConnect | Built with  using Laravel</p>
</footer>

</body>
</html>
