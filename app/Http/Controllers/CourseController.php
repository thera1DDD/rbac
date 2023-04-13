<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function  index(){
        $courses = Course::all();
        return view('course.index',compact('courses'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $data['main_image'] = Storage::disk('public')->put('/images/courses',$data['main_image']);
        Course::firstOrCreate($data);
        return redirect()->route('course.index')->with('success','Course created');
    }



    public function create(){
        $courses = Course::all();
        $languages = Language::all();
        return view('course.create',compact('courses','languages'));
    }


    public function update(UpdateRequest  $request, Course $course){
       $data = $request->validated();
       $course->update($data);
       return redirect()->route('course.index')->with('success','Course updated');
    }

    public function show(Course $courses,Language $languages ){
        return view('course.show',compact('courses','languages'));
    }

    public function edit(Course $course){
        $languages = Language::all();
        return view('course.edit',compact('course','languages'));
    }
    public function delete(Course $course){
        $course->delete();
        return redirect()->route('course.index')->with('success','Course deleted');
        }


    public function play($id)
    {
        $course = Course::findOrFail($id);
        $image = $course->main_image;

        return view('course.show', compact('image'));
    }



























//    public function getAll(){
//        $courses = Course::latest()->get();
//        $courses->transform(function($course){
//            $course->module = $course->getModulNames()->first();
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
