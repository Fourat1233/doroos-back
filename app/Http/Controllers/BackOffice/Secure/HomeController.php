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

class HomeController extends Controller
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
        return view('back_office.secure.home')
            ->with('subjects_count', $subjects_count)
            ->with('teachers_count', $teachers_count)
            ->with('students_count', $students_count)
            ->with('teachers', $teachers)
            ->with('students', $students);
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'password_' => 'required|min:6'
        ]);

        $admin = Admin::find(Auth::user()->id);
        $hasher = app('hash');
        if ($hasher->check($request->old_password, $admin->encrypted_password)) {
            $admin->encrypted_password = bcrypt($request->password);
            $admin->save();
            $this->authManager->guard('web-admin')->logout();
            return redirect('/back_office/login');
        } else {
            return back();
        }

    }
}
