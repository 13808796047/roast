<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use InvalidArgumentException;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    public function getSocialRedirect($account)
    {
        try {
            return Socialite::with($account)->redirect();
        } catch (InvalidArgumentException $e) {
            return redirect('login');
        }
    }
    public function getSocialCallback($account)
    {
        //从第三方OAuth回调中获取用户信息
        $socialUser = Socialite::with($account)->user();
        //在本地users表中查询用户来判断是否已存在
        $user = User::where(['provider_id' => $socialUser->id, 'provider' => $account])->first();
        if (!$user) {
            //如果用户不存在则将其保存到users表中
            $newUser = new User();
            $newUser->name = $socialUser->getName();
            $newUser->email = $socialUser->getEmail() ?? '';
            $newUser->avatar = $socialUser->getAvatar();
            $newUser->password = '';
            $newUser->provider = $account;
            $newUser->provider_id = $socialUser->getId();
            $newUser->save();
            $user = $newUser;
        }
        //手动登录该用户
        \Auth::login($user);
        //登录成功将用户重定向到首页
        return redirect('/#/home');
    }
}
