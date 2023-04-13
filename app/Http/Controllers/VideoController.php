<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\UpdateRequest;
use App\Models\Course;
use App\Models\Module;
use App\Models\Video;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function  index(){
        $videos = Video::all();
        return view('video.index',compact('videos'));
    }
//
//    public function store(StoreRequest $request){
//        $data = $request->validated();
//        $data['path'] = Storage::disk('public')->put('/videos',$data['path']);
//        Video::firstOrCreate($data);
//        return redirect()->route('video.index')->with('success','Video created');
//    }

    public function create(){
        $videos = Video::all();
        $modules = Module::all();
        return view('video.create',compact('videos','modules'));
    }


    public function update(UpdateRequest  $request, Video $video){
        $data = $request->validated();
        $data['video_file'] = Storage::disk('public')->put('/videos',$data['video_file']);
        $video->update($data);
        return redirect()->route('video.index')->with('success','Video updated');


    }

    public function edit(Video $video){
        $modules = Module::all();
        return view('video.edit',compact('video','modules'));
    }

    public function delete(Video $video){
        $video->delete();
        return redirect()->route('video.index')->with('success','Video deleted');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'modules_id'=> 'required',
            'video_file' => 'required|mimetypes:video/mp4,video/avi|max:1000000',
        ]);

        $video = new Video();
        $video->name = $request->name;
        $video->description = $request->description;
        $video->modules_id = $request->modules_id;
        $video_file = $request->file('video_file');
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('videos', $video_file_name, 'public');
        $video->video_file = $video_file_path;

        $video->save();

        return redirect()->route('video.index')->with('success','Video created');
    }

    public function play($id)
    {
        $video = Video::findOrFail($id);
        $video_file_path = Storage::url($video->video_file);

        return view('video.show', compact('video_file_path'));
    }















//
//    public function show(Video $videos,Language $languages ){
//        return view('video.show',compact('video','languages'));
//    }
//

//    public function getAll(){
//        $video = Video::latest()->get();
//        $video->transform(function($video){
//            $video->video = $video->getModulNames()->first();
//            return $video;
//        });
//
//        return response()->json([
//            'users' => $video
//        ], 200);
//
//
//    }
}
