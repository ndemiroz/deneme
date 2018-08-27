<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session ;
use Uuid ;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('posts.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, array(
               'title'         => 'required|max:255',
               'body'          => 'required'
           ));
$ids = DB::table('ids')->where('id_name', 'post_id')->first();

$nextid=$ids['next_id']+1;
$it = Uuid::generate();
DB::table('ids')->where('id_name', 'post_id')->update(['next_id' => $nextid]);
DB::table('posts')->insert(['title' => $request->title, 'body' => $request->body,'id'=>$nextid]);
Session::flash('success','Basarili Eklendi') ;
return redirect()->route('posts.show',$nextid) ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


 $post = DB::table('user')->where('name', $id)->first();

     return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
