<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Config ;
use App;
use StoriaApi ;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Redirect ;

use App\Http\Requests;
class PagesControllers extends Controller
{
  public function getIndex()
  {
    if (Session::has('locale')){
      $lang=Session::get('locale') ;
      }else{
      $lang=Config::get('app.locale') ;
      }

$user= StoriaApi::populerUser($lang,20,0);
$slider= StoriaApi::featuredSlider($lang,12,0);
$categories= StoriaApi::getDiscoverMenuTags($lang,20,0) ;
$collection= StoriaApi::populerCollection($lang,20,0);
$latest= StoriaApi::discoverLatest($lang,12,0);

  return view('storia.home')->withCategories($categories)->withUser($user)->withSlider($slider)->withCollection($collection)->withLatest($latest);
  }
  public function getTerms()
  {
    if (Session::has('locale')){
      $locale=Session::get('locale') ;
      }else{
      $locale=Config::get('app.locale') ;
      }
      $template='storia.static.terms' ;
    switch ($locale){
    case 'tr': $template='storia.static.terms-tr' ; break;
    case 'eng':$template='storia.static.terms' ; break;
    default: $template;
  }
  return view($template);
  }
  public function getNamik()
  {

  return view('storia.tag.tag');
  }
  public function getMoment()
  {
  return view('storia.posts.single') ;
  }
  public function getLogin()
  {
return view('auth.login') ;
  }
  public function getLoginCheck(Request $request)
  {
    $body['password'] = $request->input('password');
    $body['remember'] =true ;
    $authAccountId= $request->input('email') ;
    $usersauth =StoriaApi::postUserLogin($authAccountId, 'Selfish',$body) ;

Session::put('authenticated',true);
Session::put('user', $usersauth);
  Cookie::queue('SSID', $usersauth->sessionId, 999999999);
  Cookie::queue('accountId_preprod', $usersauth->userId, 999999999);
  Cookie::queue('userId', $usersauth->userId, 999999999);
  Cookie::queue('ui_lang', $usersauth->uiLang, 999999999);

     return redirect()->to('/') ;
    //return view('pages.about')->withName($usersauth);
  }
  public function getAbout()
  {

$jar = new \GuzzleHttp\Cookie\CookieJar();

$domain = '.preprod.storia.me';
$SSID = Cookie::get('SSID');
$accountId_preprod= Cookie::get('accountId_preprod');
$userId= Cookie::get('userId');
$ui_lang= Cookie::get('ui_lang');
$values = ['SSID' => $SSID ,'accountId_preprod'=>$accountId_preprod,'userId'=>$userId,'ui_lang'=>$ui_lang];
$cookieJar = $jar->fromArray($values,$domain);
$client   = new Client();
$response = $client->get('https://preprod.storia.me/api/acl/session/check', ['headers' => [
          'Content-Type' => 'application/json',
          'Accept' => 'application/json',
            ],
'cookies'  => $cookieJar
          ]);

return view('pages.about')->withName($response);
  }
}
