<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use StoriaApi ;
class AuthorController extends Controller
{
  public function getSingle($authAccountId) {
      	$user = StoriaApi::userByAccountId($authAccountId) ;
        $moments =StoriaApi::getUserMoments($user->id,0,20) ;
      	return view('storia.author.single')->withUser($user)->withPosts($moments);
    }
      public function getCollections($authAccountId) {
          	$usersId = StoriaApi::userByAccountId($authAccountId) ;
            $authorId =$usersId->id ;
            $filter='Owned' ;
            $limit=10 ;
            $offset=0 ;
	          $posts= StoriaApi::userCollections($authorId,$filter,$limit,$offset) ;
          	return view('storia.author.collections')->withPosts($posts)->withUser($usersId);


            }
}
