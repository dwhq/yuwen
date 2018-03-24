<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\mood;
use App\Http\Controllers\Home\PublicControllerr;

class MoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mood = new mood;
        $data = $mood->where([['state',1]])->get();
        $public= new PublicControllerr();
        $colum = $public->column();
        $info = $public->info();
        $tag = $public->tag();
        $url = $public->url();
        $title='';
        $new_article = $public->new_article();
        $type='';
        return view('Home/mood')
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('tag',$tag)
            ->with('data',$data)
            ->with('url',$url)
            ->with('title',$title)
            ->with('new_article',$new_article);

    }

}
