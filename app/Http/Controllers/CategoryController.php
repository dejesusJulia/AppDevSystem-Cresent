<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->others !== null || $request->others !== ''){
            $request->validate([
                'others' => 'max:255'
            ]);
        }
    
        $data = $request->all();

        Category::create($data);

        return redirect()->back()->with('message', 'Field edited');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::where('id', $category->id)->delete();
        return redirect()->back()->with('message', 'Delete successful');
    }

    public function getUserCateg($userId){
        $user = Category::select('id')->where('user_id', $userId)->get();
        $categories = [];

        if($user == null){
            $categories = [0];
        }else{
            $categories = Category::leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'subjects.subject_name')->where('user_id', $userId)->get();
        }

        return $categories;
    }

    public function joinCUS(){
        $categories = Category::join('users', 'categories.user_id', '=', 'users.id')->join('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar', 'subjects.subject_name')->orderBy('users.created_at', 'desc')->get();

        return $categories;
    }

}
