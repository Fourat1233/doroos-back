<?php

namespace App\Http\Controllers\FrontOffice\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TeacherRepository;
use App\Instructor;
use App\Student;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * @var TeacherRepository
     */
    private $teacherRepository;

    public function __construct(AuthManager $authManager,  TeacherRepository $teacherRepository)
    {
        $this->authManager = $authManager;
        $this->teacherRepository = $teacherRepository;

        if (!Auth::check())
        {
            return redirect()->to('/');
        }
    }

    public function showLoginForm() {
        return view('front_office.guest.signin');
    }


    public function step1(Request $request) {
     //   $request->session()->remove('account');
        return view('front_office.secure.create_profile.step1');
    }

    public function showRegisterForm() {
        return view('front_office.guest.signup');
    }

    private function credentials(array $form): array {
        return [
            'email' => $form['email'],
            'password' => $form['password']
        ];

    }

    public function login(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        if($this->authManager->guard('web')->attempt(['contact_point' => $request->get('email'), 'password' => $request->get('password')])){
            if(Auth::user()->userable_type == 'App\Instructor') {
                $instructor = Instructor::find(Auth::user()->userable_id);
                if(!$instructor->is_completed){
                    return redirect()->intended(route('front.secure.profile.step1', app()->getLocale()));
                }
                return redirect()->intended(route('front.home', app()->getLocale()));
            } else {
                return redirect()->intended(route('front.home', app()->getLocale()));
            }
        }
        return back()->with('error', 'Error : Incorrect email or password.');
    }

    public function register(Request $request) {
        $user = null;

        $request->validate([
            'full_name' => 'required',
            'contact_point' => 'required|unique:users',
            'phone_number' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'account_type' => 'required|not_in:0'
        ]);

        $account = new User();
        if($request->file) {
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('uploads/users'), $fileName);
            $account->profile_image = $fileName;
        }
        
        if($request->account_type === 'student') {
            $user = Student::create();
        } elseif($request->account_type === 'teacher') {
            
            $user = Instructor::create();
        }

        $account->full_name = $request->full_name;
        $account->contact_point = $request->contact_point;
        $account->phone_cell = $request->phone_number;
        $account->encrypted_password = bcrypt($request->password);
        $account->userable_type = $request->account_type === 'student' ? Student::class : Instructor::class;
        $account->userable_id = $user->id;

        $account->save();

        return redirect(route('front.signin', app()->getLocale()))->with('success','Your account successfully created.');
    }

    public function logout() {
        $this->authManager->guard('web')->logout();
        return redirect(route('front.home'));
    }}
