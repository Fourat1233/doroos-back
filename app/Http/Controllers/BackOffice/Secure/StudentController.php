<?php

namespace App\Http\Controllers\BackOffice\Secure;

use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web-admin');
    }

    public function index() {
        $students = User::whereHasMorph('userable', ['App\Student'])->orderBy('created_at', 'desc')->paginate(10);
        return view('back_office.secure.student.home', compact('students'));
    }

    public function search(Request $request) {
        if($request->ajax())
        {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $students = User::whereHasMorph('userable', ['App\Student'], function ($q) use ($query) {
                $q->where('contact_point', 'like', '%'.$query.'%')->orWhere('full_name', 'like', '%'.$query.'%');
            })->orderBy('created_at', 'desc')->paginate(10);
            return view('back_office.secure.student.pagination_data', compact('students'))->render();
        }
    }
}
