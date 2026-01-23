<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function studentDashboard()
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Student not available. Please login.');
        }

        
        if (Auth::user()->role !== 'student') {
            return redirect()->back()
                ->with('error', 'Student not available.');
        }

        $user = Auth::user();

        $courses = Course::with('teacher')->latest()->get();

        $notifications = $user->notifications()->latest()->take(5)->get();
        $unreadCount  = $user->unreadNotifications()->count();

        return view('students.dashboard', compact(
            'courses',
            'notifications',
            'unreadCount'
        ));
    }

    
    public function teacherDashboard()
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Teacher not available. Please login as teacher.');
        }

        
        if (Auth::user()->role !== 'teacher') {
            return redirect()->back()
                ->with('error', 'Teacher not available.');
        }

        $user = Auth::user();

        $courses = Course::where('teacher_id', $user->id)->latest()->get();

        $notifications = $user->notifications()->latest()->take(5)->get();
        $unreadCount  = $user->unreadNotifications()->count();

        return view('teacher.dashboard', compact(
            'courses',
            'notifications',
            'unreadCount'
        ));
    }
    public function storeCourse(Request $request)
    {
      
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            return redirect()->back()
                ->with('error', 'Teacher not available.');
        }

        $request->validate([
            'title' => 'required|min:3'
        ]);

        Course::create([
            'title'      => $request->title,
            'teacher_id' => Auth::id(),
        ]);

        return back()->with('success', 'Course added successfully');
    }
}
