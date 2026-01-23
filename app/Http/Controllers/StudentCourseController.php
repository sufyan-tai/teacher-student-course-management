<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseEnrolledMail;
use App\Notifications\CourseEnrolledNotification;

class StudentCourseController extends Controller
{
    public function show($courseId)
    {
        
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return redirect()->route('login')
                ->with('error', 'Student not available. Please login.');
        }

        $course = Course::with('teacher')->findOrFail($courseId);

        return view('students.course-show', compact('course'));
    }
    
    public function enroll($courseId)
    {
        
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return redirect()->route('login')
                ->with('error', 'Student not available. Please login.');
        }

        $student = auth()->user();
        $course  = Course::with('teacher')->findOrFail($courseId);

        
        if (
            !$course->teacher ||
            $course->teacher->status === 'inactive'
        ) {
            return redirect()
                ->route('student.dashboard')
                ->with('error', 'Teacher not available');
        }

        
        if ($student->courses()->where('course_id', $courseId)->exists()) {
            return redirect()
                ->route('student.dashboard')
                ->with('success', 'Already enrolled');
        }

        
        $student->courses()->attach($courseId);

                $student->notify(
            new CourseEnrolledNotification($course, $student)
        );

        
        $course->teacher->notify(
            new CourseEnrolledNotification($course, $student)
        );

      
        Mail::to($student->email)
            ->send(new CourseEnrolledMail($course, $student));

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Enrolled successfully');
    }

    
    public function unenroll($courseId)
    {
        
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return redirect()->route('login')
                ->with('error', 'Student not available.');
        }

        $student = auth()->user();

        
        if (! $student->courses()->where('course_id', $courseId)->exists()) {
            return redirect()
                ->route('student.dashboard')
                ->with('error', 'You are not enrolled in this course');
        }

        
        $student->courses()->detach($courseId);

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Unenrolled successfully');
    }
}
