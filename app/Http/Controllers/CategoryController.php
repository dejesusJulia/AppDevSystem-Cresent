<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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

    // GET ALL CATEGORIES OF A USER
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

    // JOIN CATEGORIES, USERS, AND SUBJECTS TABLE
    public function joinCUS(){
        $categories = Category::join('users', 'categories.user_id', '=', 'users.id')->join('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar', 'subjects.subject_name')->orderBy('users.created_at', 'desc')->get();

        return $categories;
    }

}
