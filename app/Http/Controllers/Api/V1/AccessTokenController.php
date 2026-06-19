<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device'=>['nullable'.'string']
        ]);

        $user = User::query()->where('email', '=', $request->post('email'))->first();
        if (!$user || Hash::check($request->post('password'), $user->password)) {
          return Response::json([
            'status'=>'unauthenticated',
            'message'=>'Invalid email or password',
          ],401);
        }

        $token = $user->createToken(
            $request->post('device',$request->userAgent()),
            ['posts.create','posts.update','posts.delete'],
            now()->addDays(30),
        );

        return Response::json([
            'token'=>$token->plainTextToken,
            'user'=>$user,
        ],201);
    }
}
