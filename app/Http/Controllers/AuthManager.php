<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function logout(){
        Session:flush();
        Auth::logout();
        return view('login');
    }

    function studentProfile(){  
        $student = Auth::guard('student')->user();
        if ($student) {
            return view('studentProfile', ['student' => $student]);
        }
        return redirect(route('login'));
    }

    function teacherProfile(){
        $teacher = Auth::guard('teacher')->user();
        if ($teacher) {
            return view('teacherProfile', ['teacher' => $teacher]);
        }
        return redirect(route('login'));
    }

    function register(){
        return view('register');
    }

    function resetPassword(){
        return view('resetPassword');
    }

    function loginPost(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::guard('student')->attempt($credentials)) {
        return redirect()->route('student.profile');
    }
        if (Auth::guard('teacher')->attempt($credentials)) {
        return redirect()->route('teacher.profile');
    }

    return redirect(route('login'))->with('error', 'Login details are not correct');
    }
    

    function registerStudent(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required'
        ]);

        $data['name'] = $request->name; 
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = Student::create($data);
        if(!$user) {
            return redirect(route('register'))->with("error", "Registration details are invalid");
        }
        return redirect(route('login'));
    }

    function registerTeacher(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required'
        ]);

        $data['name'] = $request->name; 
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = Teacher::create($data);
        if(!$user) {
            return redirect(route('register'))->with("error", "Registration details are invalid");
        }
        return redirect(route('login'));
    }

    function updateStudentName(Request $request){
        $student = auth('student')->user();

        if ($student) {
            $student->update(['name' => $request->name]);
            return redirect(route('login'));
        } else {
            return redirect(route('login'));
        }
    }

    function updateStudentPassword(Request $request){
        $student = auth('student')->user();

        if ($student) {
            $student->update(['password' => Hash::make($request->password)]);
            return redirect(route('login'));
        } else {
            return redirect(route('login'));
        }
    }

    function studentProfilePost() {
        return redirect(route('student.profile'));
    }
    
    function updateTeacherName(Request $request){
        $teacher = auth('teacher')->user();

        if ($teacher) {
            $teacher->update(['name' => $request->name]);
            return redirect(route('login'));
        } else {
            return redirect(route('login'));
        }
    }

    function updateTeacherPassword(Request $request){
        $teacher = auth('teacher')->user();

        if ($teacher) {
            $teacher->update(['password' => Hash::make($request->password)]);
            return redirect(route('login'));
        } else {
            return redirect(route('login'));
        }
    }

    function teacherProfilePost() {
        return redirect(route('teacher.profile'));
    }
}
