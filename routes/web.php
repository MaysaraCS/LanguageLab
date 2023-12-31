<?php

use App\Http\Controllers\AssessmentController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthManager;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ContentController;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AuthManager::class, 'login'])->name('login');

Route::get('/studentProfile', [AuthManager::class, 'studentProfile'])->name('student.profile')->middleware('auth:student');

Route::get('/teacherProfile', [AuthManager::class, 'teacherProfile'])->name('teacher.profile')->middleware('auth:teacher');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/register', [AuthManager::class, 'register'])->name('register');

Route::get('/reset-password', [AuthManager::class, 'resetPassword'])->name('resetPassword');

Route::post('/', [AuthManager::class, 'loginPost'])->name('login.post');

Route::post('/studentRegistration', [AuthManager::class, 'registerStudent'])->name('register.student');

Route::post('/teacherRegistration', [AuthManager::class, 'registerTeacher'])->name('register.teacher');

Route::post('/reset-password', [AuthManager::class, 'resetPasswordPost'])->name('resetPassword.post');

Route::post('/studentName', [AuthManager::class, 'updateStudentName'])->name('update.student.name');

Route::post('/studentPassword', [AuthManager::class, 'updateStudentPassword'])->name('update.student.password');

Route::post('/studentProfile', [AuthManager::class, 'studentProfilePost'])->name('student.profile.post');

Route::post('/teacherName', [AuthManager::class, 'updateTeacherName'])->name('update.teacher.name');

Route::post('/teacherPassword', [AuthManager::class, 'updateTeacherPassword'])->name('update.teacher.password');

Route::post('/teacherProfile', [AuthManager::class, 'teacherProfilePost'])->name('teacher.profile.post');

Route::get('/teacherCourses', [ CourseController::class, 'teacherCourses'])->name('teacher.courses')->middleware('auth:teacher');

Route::post('/teacherCourses', [ CourseController::class, 'teacherCoursesPost'])->name('teacher.courses.post')->middleware('auth:teacher');

Route::post('/teacherCourses/createCourses', [ CourseController::class, 'createCourses'])->name('courses.create')->middleware('auth:teacher');

Route::get('/teacherCourses/{course}', [ AnnouncementController::class, 'displayAnnouncements'])->name('courses.display')->middleware('auth:teacher');

Route::get('/teacherCourses/{course}/participants', [ CourseController::class, 'displayParticipants'])->name('course.participants')->middleware('auth:teacher');

Route::post('/teacherCourses/{course}/participants', [ CourseController::class, 'addParticipant'])->name('course.add.participants')->middleware('auth:teacher');

Route::get('/studentCourses', [ CourseController::class, 'displayStudentCourses'])->name('student.courses')->middleware('auth:teacher');

Route::post('/teacherCourses/{course}', [ AnnouncementController::class, 'createAnnouncement'])->name('course.add.announcements')->middleware('auth:teacher');

Route::get('/studentCourses/{course}', [ AnnouncementController::class, 'displayStudentAnnouncements'])->name('student.courses.display')->middleware('auth:student');

Route::get('/teacherCourses/{course}/content', [ ContentController::class, 'display'])->name('teacher.content')->middleware('auth:teacher');

Route::post('/teacherCourses/{course}/content', [ ContentController::class, 'add'])->name('add.teacher.content')->middleware('auth:teacher');

Route::get('/download{file}', [ ContentController::class, 'download'])->name('content.download');

Route::get('/studentCourses/{course}/content', [ ContentController::class, 'studentDisplay'])->name('student.content.display')->middleware('auth:student');

Route::post('/courses/{course}/add-assessment', [AssessmentController::class, 'addAssessment'])->name('course.add.assessment')->middleware('auth.teacher');
