<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $otp = Otp::where('user_id', $user->id)
                ->where('otp', $request->otp)
                ->first();
            if ($otp && Auth::loginUsingId($user->id)) {
                return response()->json(['data' => $user->createToken('Personal Access Token')], 200);
            }
        }
    }

    public function test()
    {
        return response()->json(['data' => 'hhii'], 200);
    }
}
