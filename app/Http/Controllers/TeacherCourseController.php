<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Course::create([
            'title'      => $request->title,
            'teacher_id' => auth()->id(), 
        ]);

        return redirect()->route('teacher.dashboard')
            ->with('success', 'Course added successfully');
    }

    public function destroy($id)
    {
        $course = Course::where('id', $id)
            ->where('teacher_id', auth()->id())
            ->firstOrFail();

        $course->delete();

        return redirect()->route('teacher.dashboard')
            ->with('success', 'Course deleted successfully');
    }
    public function students($id)
    {
        $course = Course::with('students')
        ->where('id', $id)
        ->where('teacher_id', auth()->id())
        ->firstOrFail();

        return view('teacher.course-students', compact('course'));
    }

}
