<?php

namespace App\Http\Controllers\FrontOffice\Secure;

use App\Attachment;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\InstructorSubject;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatProfileController extends Controller
{
    public function step1(Request $request) {
        $request->session()->remove('account');
        return view('front_office.secure.create_profile.step1');
    }

    public function SaveStep1(Request $request) {
        $validatedData = $request->validate([
            'about' => 'required|min:300',
            'city' => 'required|not_in:0',
            'state' => 'required|not_in:0'
        ]);
        if(empty($request->session()->get('account'))){
            $profile = Instructor::find(Auth::user()->id);
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
            $subject->instructor_id = Auth::user()->id;
            $subject->subject_id = $subj;
            $subject->save();
        }

        $resExt = $request->resume->extension();
        $reusmeName = time().'-resume.'.$resExt;
        $request->resume->move(public_path('uploads/teachers/'.Auth::user()->id), $reusmeName);

        $resume = new Attachment();
        $resume->storage_path = $reusmeName;
        $resume->instructor_id= Auth::user()->id;
        $resume->attachment_type= 'RE';
        $resume->save();

        if($request->degrees) {
            $degExt = $request->degrees->extension();
            $degreesName = time().'-degrees.'.$degExt;
            $request->degrees->move(public_path('uploads/teachers/'.Auth::user()->id), $degreesName);

            $degrees = new Attachment();
            $degrees->storage_path = $degreesName;
            $degrees->instructor_id= Auth::user()->id;
            $degrees->attachment_type= 'DE';
            $degrees->save();
        }

        if($request->certificates) {
            $certExt = $request->certificates->extension();
            $certificatesName = time().'-certificates.'.$certExt;
            $request->certificates->move(public_path('uploads/teachers/'.Auth::user()->id), $certificatesName);
            $certificates = new Attachment();
            $certificates->storage_path = $certificatesName;
            $certificates->instructor_id= Auth::user()->id;
            $certificates->attachment_type= 'CE';
            $certificates->save();
        }

        if($request->experiences) {
            $expExt = $request->experiences->extension();
            $experiencesName = time().'-experiences.'.$expExt;
            $request->experiences->move(public_path('uploads/teachers/'.Auth::user()->id), $experiencesName);
            $experiences = new Attachment();
            $experiences->storage_path = $experiencesName;
            $experiences->instructor_id= Auth::user()->id;
            $experiences->attachment_type= 'EX';
            $experiences->save();
        }

        return redirect(app()->getLocale().'/');
    }

}
