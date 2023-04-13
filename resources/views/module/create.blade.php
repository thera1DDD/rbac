@extends('layouts.admin')

@section('title')
Create Module
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add new Module</h3>
        <div class="card-tools">
            <a href="{{ route('module.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Modules</a>
        </div>
    </div>
    <form method="POST" action="{{ route('module.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Название">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input type="text" name="description"  id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required placeholder="Название">
                @error('description')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Number</label>
                <input type="text" name="number"  id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" required placeholder="Название">
                @error('number')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Course</label>
                <select name="courses_id"  id="course_id" class="form-control select2" data-placeholder="Выберите курс" style="width: 100%;">
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach()
                </select>
                @error('course_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Main Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="main_image" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Загрузка</span>
                    </div>
                </div>
                @error('main_image')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Slug</label>
                <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required placeholder="Название">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Language</button>
        </div>
    </form>
</div>
@endsection
