<?php

namespace App\Http\Controllers;
use App\Models\posts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\ToObject;





use Illuminate\Http\Request;

class blogController extends Controller
{
  
    public function blog_main()
    {
        $posts = posts::where('status',1)->orderBy('created_at','DESC')->paginate(3);
        return view('blog.blog',compact('posts'));    
    }

    
    
    
        public function postslug($postslug)
        {       
        $postslug = posts::where('slug',$postslug)->get();               
        $a = json_decode(($postslug[0]->category_id));
        $cat_list[] = "";
        foreach ($a as $categorys) {
            $job_com = DB::table('categories')->select('name')->where('id', '=', $categorys) ->get();
            $listss = json_decode(($job_com));
            foreach ($listss as $a => $c) {               
                foreach ($c as $a => $b) {
                   $cat_list[] = $b;
                   
                }                
            }                        
        }
        $b = json_decode(($postslug[0]->tag_id));
        $tag_list[] = "";
        foreach ($b as $tags) {
            $job_com = DB::table('tags')->select('name')->where('id', '=', $tags)->get();
            $listss = json_decode(($job_com));
            foreach ($listss as $a => $c) {               
                foreach ($c as $a => $b) {
                   $tag_list[] = $b;                   
                }                
            }                        
        }       
             
            return view('blog.post')->with('postslug',$postslug[0])->with('cat',$cat_list)->with('tags',$tag_list);
        }
    
  
    public function store(Request $request)
    {
        //
    }
   
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
