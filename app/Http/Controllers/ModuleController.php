<?php

namespace App\Http\Controllers;

use App\Http\Requests\Module\StoreRequest;
use App\Http\Requests\Module\UpdateRequest;
use App\Models\Course;
use App\Models\Module;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    public function  index(){
        $modules = Module::all();
        return view('module.index',compact('modules'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $data['main_image'] = Storage::disk('public')->put('/images/modules',$data['main_image']);
        Module::firstOrCreate($data);
        return redirect()->route('module.index')->with('success','Module created');
    }

    public function create(){
        $modules = Module::all();
        $courses = Course::all();
        return view('module.create',compact('modules','courses'));
    }


    public function update(UpdateRequest  $request, Module $module){
        $data = $request->validated();
        $data['main_image'] = Storage::disk('public')->put('/images/modules',$data['main_image']);
        $module->update($data);
        return redirect()->route('module.index')->with('success','Module updated');


    }

    public function edit(Module $module){
        $courses = Course::all();
        return view('module.edit',compact('module','courses'));
    }

    public function delete(Module $module){
        $module->delete();
        return redirect()->route('module.index')->with('success','Module deleted');
    }
























//
//    public function show(Module $modules,Language $languages ){
//        return view('module.show',compact('module','languages'));
//    }
//

//    public function getAll(){
//        $module = Module::latest()->get();
//        $module->transform(function($module){
//            $module->module = $module->getModulNames()->first();
//            return $module;
//        });
//
//        return response()->json([
//            'users' => $module
//        ], 200);
//
//
//    }
}
