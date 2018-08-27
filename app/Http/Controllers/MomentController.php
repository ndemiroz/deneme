<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use StoriaApi ;
class MomentController extends Controller
{
  public function getIndex($userId,$momentId)
  {
  $moment= StoriaApi::momentbyid($momentId);
if($moment){
  return view('storia.posts.single')->withMoments($moment) ;
}else{
  return view('storia.404') ;
  }
  }

  public function getMoment($momentId)
  {
    $moments=StoriaApi::CollectionbyId($momentId,20,0);
if($moments){
    return view('storia.collections.collections')->withMoments($moments);
}else{
  return view('storia.404') ;
  }
  }

}
