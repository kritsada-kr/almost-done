<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;

class ChartController extends Controller
{
    public function index() {
        $label = [];
        $count = [];
        $cpm = [];

        $tags = Tag::get();
        foreach($tags as $tag){
            array_push($label, $tag->name);
            array_push($count, $tag->posts->count());
            $post_per_tag = 0;
            foreach($tag->posts as $post){
                if(date("m Y",strtotime($post->created_at)) == date("m Y",time())){
                    $post_per_tag++;
                }
            }
            array_push($cpm , $post_per_tag);
        }

        $progression = ["ยื่นคำร้อง/ปัญหา", "รับคำร้อง/ปัญหา", "กำลังดำเนินการ","เสร็จสมบูรณ์"];
        $posts = Post::get();
        foreach($posts as $post){
            if(date("m Y",strtotime($post->created_at)) == date("m Y",time())){
                array_push($progression , $post->progression);
            }
        }
        $vals = array_count_values($progression);
        $progression_count = [];
        foreach($vals as $val){
            array_push($progression_count , $val-1);
        }
        return view('chart',['labels'=> $label , 'counts' => $count , 'progesses' => $progression_count , 'count_per_month' => $cpm ] );
    }
}
