<?php

namespace App\Api\V1\Controllers;

use App\Finance;
use App\FinanceBalance;
use Carbon\Carbon;
use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use App\Role;
use Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
       if($request->role_id == 1){
           return response()->json(['status'=>false,
               'message'=>"We don't have role with id 1. We provide role id for Driver=2,Advertiser=3 and Downloader=4. please choose your role"]);
       }else{
           $userCheck = User::where('email', $request->email)->get();
           $phoneChecker = User::where('phone', $request->phone)->get();
           if (count($userCheck) <= 0 && count($phoneChecker) <= 0) {

               $user = new User();
               $user->first_name = $request->first_name;
               $user->last_name = $request->last_name;
               $user->email = $request->email;
               $user->phone = $request->phone;
               $user->avator = 'letter';
               $user->password = $request->password;
               $user->confirmation_code = $this->generateCouponCode(6);
               if($user->save()){
                   $role = Role::find($request->role_id);
                   $user->role()->sync($role);

                   $financeBalance = new FinanceBalance();
                   $financeBalance->balance = 0.0;
                   $user->balance()->save($financeBalance);

                   //login after sign up
                   $credentials = $request->only(['email', 'password']);
                   $token = Auth::guard()->attempt($credentials);
                   $role_id = User::find(Auth::guard()->user()->id)->role[0];
                   return response()->json([
                       'status' => true,
                       'role'=>$role_id,
                       'token' => $token
                   ], 201);
               }

           } else {
               if (count($userCheck) > 0) {
                   //throw new HttpException(409);
                   return response()->json(['status' => false, 'message' => 'Some one already registered by this email address'], 409);
               } else if (count($phoneChecker) > 0) {
                   return response()->json(['status' => false, 'message' => 'Some one already registered by this Phone number'], 409);
               } else {
                   return response()->json(['status' => false, 'message' => 'these email address and phone number are used by some one'], 409);
               }
           }
       }
    }

    function generateCouponCode($length = 4)
    {
        $chars = '0123456789';
        $ret = '';
        for ($i = 0; $i < $length; ++$i) {
            $random = str_shuffle($chars);
            $ret .= $random[0];
        }
        return $ret;
    }
}
