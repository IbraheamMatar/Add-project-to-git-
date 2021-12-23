<?php

namespace App\Http\Controllers;

use App\Category;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.index')->with('stores',Store::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $categories = Category::all();
        if ($categories->count() ==0   ) {

            return redirect()->route('category.create') ;

        }





        return view('stores.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            "title"    => "required",
            "content"  => "required",
            "category_id"  => "required",
            "featured" => "required|image",
        ]);

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/stores',$featured_new_name);



        $post = Store::create([
            "title"    => $request->title,
            "content"  => $request->content,
            "category_id"  => $request->category_id,
            "featrued" => 'uploads/stores/'.$featured_new_name,
            "slug"    => str_slug($request->title), // my new post => my-new-post
            "user_id" => Auth::id()
        ]);



     return redirect()->back();

   // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = store::find($id);
        return view('stores.edit')->with('stores',$store)
        ->with('categories',Category::all());
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

        $store = store::find($id);

        $this->validate($request,[
            "title"    => "required",
            "content"  => "required",
            "category_id"  => "required"

        ]);


        if ( $request->hasFile('featured')  ) {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/stores/',$featured_new_name);

            $store->featrued = 'uploads/stores/'.$featured_new_name;

        }

       // dd($post);
        $store->title =  $request->title;
        $store->content =  $request->content;
        $store->category_id = $request->category_id;
        $store->save();


        return redirect()->route('stores');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = store::find($id);
        $store->delete($id);
        return redirect()->back();
    }


    public function trashed()
    {
        $store = store::onlyTrashed()->get();
      // dd($post);
       return view('stores.softdeleted')->with('stores',$store);
    }

    public function hdelete($id)
    {
        $store = store::withTrashed()->where('id',$id)->first();
        $store->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $store = store::withTrashed()->where('id',$id)->first();
        $store->restore();
        return redirect()->route('stores');
    }

}
