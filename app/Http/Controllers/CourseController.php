<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    
     public function index()
    {
        $courses = Course::latest()->get();

        return view('courses.index', compact('courses'));
    }

    
    public function create()
    {
        return view('teacher.courses.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
        ]);

        $teacher = Auth::guard('teacher')->user();

        Course::create([
            'title' => $request->title,
            'teacher_id' => $teacher->id,
        ]);

        return redirect()->route('teacher.courses')
            ->with('success', 'Course created successfully');
    }
}
