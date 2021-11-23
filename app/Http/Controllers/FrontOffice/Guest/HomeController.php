<?php

namespace App\Http\Controllers\FrontOffice\Guest;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\Subject;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $teachers = Instructor::whereHas('subjects')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        $subjects = Subject::with('category')
            ->withCount('instructors')
            ->orderBy('instructors_count', 'desc')
            ->limit(4)
            ->get();
        return view('front_office.guest.home')
            ->with('teachers', $teachers)
            ->with('subjects', $subjects);
    }

    public function about() {
        return view('front_office.guest.about');
    }

    public function contact() {
        return view('front_office.guest.contact');
    }
}
