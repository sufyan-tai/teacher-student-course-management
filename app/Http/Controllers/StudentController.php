<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:30',
            'email'    => 'required|email|unique:students,email',
            'password' => 'required|min:6|max:6',
            'phone'    => 'required',
        ]);

        Student::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
        ]);

        return redirect('/students')->with('success', 'Student added successfully');
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required',
        ]);

        $student->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect('/students')->with('success', 'Student updated');
    }
    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        return back()->with('success', 'Student deleted');
    }
}
