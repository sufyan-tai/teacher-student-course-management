<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="edit-wrapper">
    <div class="edit-card">

        <h2>Edit Student</h2>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/update/{{ $student->id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $student->name) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $student->email) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text"
                       name="phone"
                       value="{{ old('phone', $student->phone) }}"
                       maxlength="10"
                       required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-update">
                    Update
                </button>

                <a href="/" class="btn-cancel">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
