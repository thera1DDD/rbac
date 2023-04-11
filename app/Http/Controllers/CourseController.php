<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function  index(){
        $courses = Course::all();
        return view('course.index',compact('courses'));
    }

    public function store(Request  $request){
        $this->validate($request,[
            'name' => 'required|string',
            'languages_id' => 'required',
            'main_image'=>'required',
            'slug' => 'nullable',
        ]);
        $course = new Course();
        $course->name = $request->name;
        $course->languages_id = $request->languages_id;
        $course->main_image = $request->main_image;
        $course->slug = $request->slug;

        $course->save();
        return response()->json("Course Created", 200);
    }



    public function create(){
        $courses = Course::all();
        $languages = Language::all();
        return view('course.create',compact('courses','languages'));
    }

//    public function getAll(){
//        $courses = Course::latest()->get();
//        $courses->transform(function($course){
//            $course->modul = $course->getModulNames()->first();
//            return $course;
//        });
//
//        return response()->json([
//            'users' => $courses
//        ], 200);
//
//
//    }
}
