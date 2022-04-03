<?php

namespace App\Http\Controllers\FrontOffice\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TeacherRepository;
use App\Http\Controllers\Api\V1\LocationController;

use App\Instructor;
use App\Student;
use App\User;
use App\Attachment;

use App\InstructorSubject;
use App\Subject;
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

    public function __construct(AuthManager $authManager,  TeacherRepository $teacherRepository, LocationController $LocationController)
    {
        $this->authManager = $authManager;
        $this->teacherRepository = $teacherRepository;
        $this->LocationController = $LocationController;

        if (!Auth::check())
        {
            return redirect()->to('/');
        }
    }

    public function showLoginForm() {
        return view('front_office.guest.signin');
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
    }

    
    public function step1(Request $request) {
        //   $request->session()->remove('account');
          //  dd($this->LocationController->loadall());
        $locations = json_decode(json_encode( $this->LocationController->loadall()))->original->data;
           return view('front_office.secure.create_profile.step1')->with('locations',$locations);
       }
   
       public function SaveStep1(Request $request) {
           $validatedData = $request->validate([
               'about' => 'required|min:20',
               'city' => 'required|not_in:0',
               'state' => 'required|not_in:0'
           ]);
           if(empty($request->session()->get('account'))){
               $profile = Instructor::find(Auth::user()->userable_id);
               $profile->fill($validatedData);
               $request->session()->put('account', $profile);
           }else{
               $profile = $request->session()->get('account');
               $profile->fill($validatedData);
               $request->session()->put('account', $profile);
           }
           return redirect(app()->getLocale().'/account/create/step2');
       }
   
       public function step2(Request $request) {
           // if(empty($request->session()->get('account'))){
           //     return redirect(app()->getLocale().'/account/create/step1');
           // }    
           return view('front_office.secure.create_profile.step2');
       }
   
       public function SaveStep2(Request $request) {
           $validatedData = $request->validate([
               'years_of_experience' => 'required',
               'pricing' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
               'teaching_areas' => 'required',
               'teaching_type' => 'required',
               'teaching_level' => 'required',
           ]);
   
           $validatedData['teaching_areas'] =json_encode($request->teaching_areas);
           $validatedData['teaching_type'] =json_encode($request->teaching_type);
           $validatedData['teaching_level'] =json_encode($request->teaching_level);
   
           $profile = $request->session()->get('account');
           $profile->fill($validatedData);
           $request->session()->put('account', $profile);
   
           return redirect(app()->getLocale().'/account/create/step3');
       }
   
       public function step3(Request $request) {
           // if(empty($request->session()->get('account'))){
           //     return redirect(app()->getLocale().'/account/create/step1');
           // }
           return view('front_office.secure.create_profile.step3');
       }
   
       public function SaveStep3(Request $request) {
           $validatedData = $request->validate([
               'business_hours' => 'required',
           ]);
   
           $validatedData['business_hours'] =json_encode($request->business_hours);
   
           $profile = $request->session()->get('account');
           $profile->fill($validatedData);
           $request->session()->put('account', $profile);
   
           return redirect(app()->getLocale().'/account/create/step4');
       }
   
       public function step4(Request $request) {
           // if(empty($request->session()->get('account'))){
           //     return redirect(app()->getLocale().'/account/create/step1');
           // }
           $subjects = Subject::all();
           return view('front_office.secure.create_profile.step4')->with('subjects', $subjects);
       }
   
       public function SaveStep4(Request $request) {
            $request->validate([
               'resume' => 'required',
                'subjects' => 'required'
           ]);
   
           $profile = $request->session()->get('account');
           $details = json_decode(file_get_contents("http://ipinfo.io/"));
           $coordinates = explode(",", $details->loc);
   
           $profile->latitude = $coordinates[0]; // latitude
           $profile->longitude = $coordinates[1]; // longitude
           $profile->is_completed = true;
   
           $profile->save();
   
           $subjects = $request->subjects;
           foreach($subjects as $subj){
               $subject = new InstructorSubject();
               $subject->instructor_id = Auth::user()->userable_id;
               $subject->subject_id = $subj;
               $subject->save();
           }
   
           $resExt = $request->resume->extension();
           $reusmeName = time().'-resume.'.$resExt;
           $request->resume->move(public_path('uploads/teachers/'.Auth::user()->id), $reusmeName);
   
           $resume = new Attachment();
           $resume->storage_path = $reusmeName;
           $resume->instructor_id= Auth::user()->userable_id;
           $resume->attachment_type= 'RE';
           $resume->save();
   
           if($request->degrees) {
               $degExt = $request->degrees->extension();
               $degreesName = time().'-degrees.'.$degExt;
               $request->degrees->move(public_path('uploads/teachers/'.Auth::user()->id), $degreesName);
   
               $degrees = new Attachment();
               $degrees->storage_path = $degreesName;
               $degrees->instructor_id= Auth::user()->userable_id;
               $degrees->attachment_type= 'DE';
               $degrees->save();
           }
   
           if($request->certificates) {
               $certExt = $request->certificates->extension();
               $certificatesName = time().'-certificates.'.$certExt;
               $request->certificates->move(public_path('uploads/teachers/'.Auth::user()->id), $certificatesName);
               $certificates = new Attachment();
               $certificates->storage_path = $certificatesName;
               $certificates->instructor_id= Auth::user()->userable_id;
               $certificates->attachment_type= 'CE';
               $certificates->save();
           }
   
           if($request->experiences) {
               $expExt = $request->experiences->extension();
               $experiencesName = time().'-experiences.'.$expExt;
               $request->experiences->move(public_path('uploads/teachers/'.Auth::user()->id), $experiencesName);
               $experiences = new Attachment();
               $experiences->storage_path = $experiencesName;
               $experiences->instructor_id= Auth::user()->userable_id;
               $experiences->attachment_type= 'EX';
               $experiences->save();
           }
   
           return redirect(app()->getLocale().'/');
       }

}
