<?php

namespace App;


use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
      //$account = SocialAccount::whereProvider('facebook')
        //    ->whereProviderUserId($providerUser->getId())
          //  ->first();
$account =10155037696983971 ;  //

        if ($account) {
            //return $account->user;

              return 'namik'; //
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}
