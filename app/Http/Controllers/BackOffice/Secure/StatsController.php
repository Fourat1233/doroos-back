<?php

namespace App\Http\Controllers\BackOffice\Secure;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Student;
use App\Subject;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
        $this->middleware('auth:web-admin');
    }

    public function index() {
        $subjects_count = Subject::all()->count();
        $teachers_count = Instructor::all()->count();
        $students_count = Student::all()->count();

        $teachers = Instructor::whereHas('subjects')->with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $students = User::whereHasMorph('userable', ['App\Student'])->orderBy('created_at', 'desc')->limit(5)->get();
        return view('back_office.secure.stat.home')
            ->with('subjects_count', $subjects_count)
            ->with('teachers_count', $teachers_count)
            ->with('students_count', $students_count)
            ->with('teachers', $teachers)
            ->with('students', $students);
    }


}
