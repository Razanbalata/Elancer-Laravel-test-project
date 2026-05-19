<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
 
  protected array $posts = [];
 
  public function __construct(){
   $this->posts = include resource_path("data/posts.php");
  }
  
  
    //
    public function index(){
        return view('index',[
            'posts'=>$this->posts,
        ]);
    } 

    public function show(int $id,string $post){

       $post = null;
       foreach($this->posts as $p){
        if($p['id']=== $id){
            $post=$p;
            break;
        }
       }

        return view("single-standard",[
            'post'=>$post
        ]);
    }

}
