<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

   <link stylesheet href="app.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    
    <nav class="bg-white shadow mb-10">
        <div class="max-w-5xl mx-auto px-6 py-4 flex space-x-6">
            <a href="/" class="text-blue-600 font-semibold hover:text-blue-800">
                Home
            </a>
            <a href="/about" class="text-blue-600 font-semibold hover:text-blue-800">
                About
            </a>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="max-w-5xl mx-auto px-6">
        @yield('content')
    </div>

</body>
</html>
