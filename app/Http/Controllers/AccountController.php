<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function getBalance(Request $request){
        $user=$request->user();
        $account=Account::where('user_id',$user->id)->first();
        return response()->json(['balance' => $account->balance],200);
    }

    public function getToken(Request $request){
        $user = $request->user();
        $token = $user->createToken('UserToken')->plainTextToken;
        return response()->json([
            'message' => 'Token created successful',
            'Token' => $token
        ],200);
    }
}
