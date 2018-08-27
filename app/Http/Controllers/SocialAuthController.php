<?php
namespace App\Http\Controllers;
use App\SocialAccountService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Session ;
class SocialAuthController extends Controller
{
  public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {

      $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

    Session::put('authenticated',true);
              Session::put('user', $user);

         return redirect()->to('/') ;

         //return view('pages.welcome')->withName($user);
    }
}
