<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrolled Students</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stud.css') }}">

    
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

<div class="dashboard">

   
    <div class="header">
        <h2>
            <span class="course">=>Course : </span>
            {{ $course->title }}
        </h2>

        <a href="{{ route('teacher.dashboard') }}" class="btn btn-success back-btn">
         ← Back to Dashboard
        </a>

    </div>

    
    <div class="card">
        <div class="card-head">
            <h3> Enrolled Students :</h3>
            <span class="count">
                Total: {{ $course->students->count() }}
            </span>
        </div>

        @if($course->students->count())
            <table id="studentsTable" class="datatable">
                <thead>
                    <tr>
                        <th> Name</th>
                        <th> Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course->students as $student)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <span class="avatar">
                                        {{ strtoupper(substr($student->name,0,1)) }}
                                    </span>
                                    {{ $student->name }}
                                </div>
                            </td>
                            <td>{{ $student->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="empty-text"> No students enrolled yet.</p>
        @endif
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#studentsTable').DataTable({
        pageLength: 2,
        lengthChange: false,
        ordering: true,
        searching: true,
        info: false,
        language: {
            search: "Search Student:"
        }
    });
});
</script>

</body>
</html>
