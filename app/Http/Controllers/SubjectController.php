<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Category;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * DISPLAY ALL SUBJECTS
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects', compact('subjects'));
    }


    // DISPLAY ALL SUBJECTS (FOR ANOTHER PAGE)
    public function showAllSub(){
        return Subject::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_name' => 'required|max:50', 
            'subject_description' => 'required|max:200'
        ]);

        Subject::create($data);
        return redirect()->back()->with('message', 'New subject added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject = Subject::where('id', $subject->id)->first();
        return $subject;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'subject_name' => 'required|max:50', 
            'subject_description' => 'required|max:200'
        ]);

        Subject::where('id', $subject->id)->update($data);

        return redirect()->back()->with('message', 'Subject updated successfully');
    }

    /**
     * DELETE SUBJECT
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $categories = Category::where('subject_id', $subject->id)->get();
        // CHECK IF SUBJECT IS USED BY USER
        if($categories !== null){
            Category::where('subject_id', $subject->id)->delete();
        }
        
        Subject::where('id', $subject->id)->delete();
        return redirect()->back()->with('message', 'Subject deleted successfully');
    }

    // GET NUMBER OF SUBJECTS
    public function getSubCount(){
        return Subject::count();
    }
}
