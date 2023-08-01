<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Mail\OTPMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function userLoginView()
    {
        return view('pages.auth.login');
    }

    public function userRegistrationView()
    {
        return view('pages.auth.registration');
    }

    public function userLogoutView()
    {
        return view('pages.auth.logout');
    }

    public function userProfileView()
    {
        return view('pages.auth.profile');
    }

    public function userResetPasswordView()
    {
        return view('pages.auth.reset-password');
    }

    public function userVerifyOTPView()
    {
        return view('pages.auth.verify-otp');
    }

    public function getOTPCode(){
        return view('pages.auth.get-otp');
    }



    public function userLogin(Request $request)
    {
        $userEmail = $request->input('email');
        $userPassword = $request->input('password');
        $user = User::where('email', $userEmail)->count();
        if ($user == 1) {
            if(User::where('email', $userEmail)->first()->password == $userPassword){
                $token = JWTToken::createJWTToken($userEmail);
                return response()->json(['token' => $token], 200)->cookie('token', $token, 60*60*24);
            }else{
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function userRegistration(Request $request)
    {
        $userEmail = $request->input('email');
        $user = User::where('email', $userEmail)->first();
        if ($user) {
            return response()->json(['error' => 'User already exists'], 401);
        } else {
            User::create($request->input());
            return response()->json(['success' => 'User created successfully.'], 200);
        }
    }

    public function userLogout(Request $request)
    {
        return redirect('/user-login')->cookie('token', '', -1);
    }

    public function sendOTPtoEmail(Request $request){
        $userEmail = $request->input('email');
        $otp = rand(100000, 999999);
        $user = User::where('email', $userEmail)->count();
        if ($user == 1) {
            Mail::to($userEmail)->send(new OTPMailer($otp));
            User::where('email', $userEmail)->update(['otp' => $otp]);
            return response()->json(['success' => 'OTP sent successfully.'], 200);

        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }
    public function verifyOTP(Request $request){
        $userEmail = $request->input('email');
        $code = $request->input('code');

        if($code === 0){
            return response()->json(['error' => 'Unauthorized hhh'], 401);
        }

        $count = User::where('email', $userEmail)->where('otp', '=', $code)->count();

        if ($count == 1) {
            User::where('email', $userEmail)->update(['otp' => 0 ,'otpVerified' => 1]);
            $token = JWTToken::createJWTToken($userEmail);
            return response()->json(['success' => 'OTP verified successfully.'], 200)->cookie('token', $token, 60*60*24);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }
    public function updateProfile(){}
    public function resetPassword(Request $request){

        try {
            $password = $request->input('password');
            $email = $request->header('email');

            User::where('email', $email)->update(['password' => $password]);

            return response()->json(['success' => 'Password updated successfully.'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }

    }


}
