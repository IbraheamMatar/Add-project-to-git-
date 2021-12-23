<?php

namespace App\Http\Controllers;

use App\Category;
use App\Store;
use Illuminate\Http\Request;

class siteUIcontroller extends Controller
{
    //


    public function index()
    {
        return view('index')
                            ->with('categories' , Category::take(3)->get() )
                            ->with('first_post' , Store::orderBy('created_at','desc')->first())
                            ->with('second_post' , Store::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post' , Store::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
                            ->with('fourth_post' , Store::orderBy('created_at','desc')->skip(3)->take(1)->get()->first())
                            ->with('ruby_on_rails',  Category::find(1) )
                            ->with('laravel',  Category::find(1) )
                            ->with('django_python',  Category::find(1) )
                             ;

    }





    public function showPost($slug)
    {

        $post      = Store::where('slug' , $slug)->first();
        $next_page =Store::where('id' , '>' ,$post->id)->min('id');
        $prev_page = Store::where('id' , '<' ,$post->id)->max('id');


        return view('stores.show')

                             ->with('post' , $post)
                             ->with('next' , Store::find($next_page))
                             ->with('prev' , Store::find($prev_page))
                            ->with('title' , $post->title)
                            ->with('categories' , Category::take(5)->get() )   ;

    }



    public function category($id)
    {

        $category      = Category::find($id);

        return view('categories.category')
                            ->with('title' , $category->name)
                            ->with('categories' , Category::take(5)->get() )
                            ->with('name' , $category->name )
                            ->with('category' , $category )    ;

    }



}
