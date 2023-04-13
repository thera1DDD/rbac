<?php

namespace App\Http\Controllers;

use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('language.index',compact('languages'));
    }

    public function create(){
        return view('language.create');
    }


    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|string'
        ]);

        $language = new Language();
        $language->name = $request->name;
        $language->save();
        return redirect()->route('language.index')->with('success','Language created');
    }

    public function edit(Language $language){
        return view('language.edit',compact('language'));
    }
    public function delete(Language $language){
        $language->delete();
        return redirect()->route('language.index')->with('success','Language deleted');
    }

    public function update(UpdateRequest  $request, Language $language){
        $data = $request->validated();
        $language->update($data);
        return redirect()->route('language.index')->with('success','Language updated');
    }
}
