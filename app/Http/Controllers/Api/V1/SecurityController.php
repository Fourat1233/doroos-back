<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\IssueTokenTrait;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Repositories\TokenRepository;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SecurityController extends Controller
{

    use IssueTokenTrait;

    /**
     * @var TokenRepository
     */
    private $tokenRepository;

    /**
     * @var Client
     */
    private $client;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->client = $tokenRepository->findClientById(1);
    }

    public function signUp(Request $request) {

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

        return response()->json(['success', 200]);
    }

   /**
     * Sign in the incoming request and issue access token
     * @bodyParam contact_point (email)
     * @bodyPara encrypted_password (password)
     * @return mixed
     */
    public function signIn(Request $request)
    {
        $this->validateCredentials($this->credentials($request))->validate();
        return $this->issueToken($request, 'password', $this->credentials($request));
    }

    /**
     * Refresh the expired access token
     * @param Request $request
     */
    public function refresh(Request $request)
    {
        $this->validateRefreshToken($request->only('refresh_token'))->validate();
        return $this->issueToken($request, 'refresh_token', $request->only('refresh_token'));
    }

     /**
     * Validate the incoming username and password
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateCredentials(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            $this->username() => ['required', 'string'],
            $this->password() => ['required', 'string', 'min:6']
        ]);
    }

    /**
     * Validate the refresh token
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateRefreshToken(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, ['refresh_token' => ['required']]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    private function username(): string
    {
        return 'contact_point';
    }

    /**
     * Get the login password to be used by the controller.
     *
     * @return string
     */
    private function password(): string
    {
        return 'password';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  Request  $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return $request->only(
            $this->username(),
            $this->password()
        );
    }
}

